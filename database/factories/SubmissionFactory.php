<?php

namespace Database\Factories;

use App\Models\Consumer;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->phoneNumber,
            'contact_preference' => 'email',
            'consumer_id' => Consumer::factory()->create()->id,
            'city' => fake()->name,
            'state_id' => State::factory()->create()->id,
            'zipcode' => '12345'
        ];
    }
}
