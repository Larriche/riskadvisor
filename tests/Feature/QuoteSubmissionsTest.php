<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\State;
use App\Models\InsuranceProduct;

class QuoteSubmissionsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function test_quote_form_can_be_viewed_without_authentication(): void
    {
        $response = $this->get('/submission');

        $response->assertStatus(200);
    }

     /**
     * @test
     * @dataProvider invalidQuoteFormData
     */
    public function test_creating_quote_submission_with_invalid_data_fails($data, $assertableField): void 
    {
        $response = $this->post('/quote', [
            'first_name' => ''
        ])->assertSessionHasErrors($assertableField);
    }

    public function test_quote_submissions_are_saved_with_valid_data()
    {
        $data = [
            'first_name' => 'Test name',
            'last_name' => 'Test last name',
            'email' => 'quotetest@example.com',
            'product_ids' => [InsuranceProduct::first()->id],
            'state_id' => State::first()->id,
            'phone' => '1234567890',
            'contact_preference' => 'email',
            'zipcode' => '12345',
            'city' => 'test'
        ];

        $response = $this->post('/submission', $data);
        $this->assertDatabaseHas('consumers', [
            'email' => 'quotetest@example.com',
            'first_name' => 'Test name',
        ]);

        $this->assertDatabaseHas('submissions', [
            'phone' => '1234567890',
            'contact_preference' => 'email',
            'zipcode' => '12345',
            'city' => 'test'
        ]);
    }

    public static function invalidQuoteFormData()
    {
        $goodData = [
            'first_name' => 'Test name',
            'last_name' => 'Test last name',
            'email' => 'test@example.com',
            'product_ids' => [1],
            'state_id' => 1,
            'phone' => '1234567890',
            'contact_preference' => 'email',
            'zipcode' => '12345',
            'city' => 'test'
        ];

        return [
            'No first name' => [array_merge($goodData, ['first_name' => '']), 'first_name'],
            'No last name' => [array_merge($goodData, ['last_name' => '']), 'last_name'],
            'No email' => [array_merge($goodData, ['email' => '']), 'email'],
            'Bad email' => [array_merge($goodData, ['email' => 'testing']), 'email'],
            'No phone' => [array_merge($goodData, ['phone' => '']), 'phone'],
            'Bad phone' => [array_merge($goodData, ['phone' => '12345test']), 'phone'],
            'No products' => [array_merge($goodData, ['product_ids' => []]), 'product_ids'],
            'No state' => [array_merge($goodData, ['state_id' => '']), 'state_id'],
            'No city' => [array_merge($goodData, ['city' => '']), 'city'],
            'No state' => [array_merge($goodData, ['zipcode' => '']), 'zipcode'],
        ];
    }
}