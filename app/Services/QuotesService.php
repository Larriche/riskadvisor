<?php 

namespace App\Services;

use App\Models\Consumer;
use App\Models\Submission;
use Illuminate\Support\Arr;

class QuotesService
{
    public function saveQuote(array $data): Submission
    {
        $email = Arr::get($data, 'email');

        $consumer = Consumer::where('email', $email)->first();

        if ($consumer === null) {
            $consumer = new Consumer();

            $consumer->email = $email;
            $consumer->first_name = Arr::get($data, 'first_name');
            $consumer->last_name = Arr::get($data, 'last_name');
            $consumer->save();
        }

        return $this->createQuoteSubmission($consumer, $data);
    }

    public function createQuoteSubmission(Consumer $consumer, array $data): Submission
    {
        $submission = new Submission();

        $submission->consumer_id = $consumer->id;
        $submission->phone = Arr::get($data, 'phone');
        $submission->state_id = Arr::get($data, 'state_id');
        $submission->contact_preference = Arr::get($data, 'contact_preference');
        $submission->street_address = Arr::get($data, 'street_address');
        $submission->apartment = Arr::get($data, 'apartment');
        $submission->city = Arr::get($data, 'city');
        $submission->zipcode = Arr::get($data, 'zipcode');

        $submission->save();
        $submission->products()->sync(Arr::get($data, 'product_ids'));

        return $submission;
    }
}