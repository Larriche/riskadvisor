<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\State;
use App\Models\InsuranceProduct;
use App\Models\Submission;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Inertia\Testing\AssertableInertia as Assert;


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
        $response = $this->post('/submission', [
            'first_name' => ''
        ])->assertSessionHasErrors($assertableField);
    }

    public function test_quote_submissions_are_saved_with_valid_data()
    {
        $product = InsuranceProduct::factory()->create();
        $state = State::factory()->create();

        $data = [
            'first_name' => 'Test name',
            'last_name' => 'Test last name',
            'email' => 'quotetest@example.com',
            'product_ids' => [$product->id],
            'state_id' => $state->id,
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

    public function test_unauthenticated_users_cannot_see_submissions()
    {
        $response = $this->get('/submissions');

        $response->assertStatus(302);
    }

    public function test_authenticated_users_can_see_submissions()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user)
            ->get('/submissions')
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Admin/Submissions')
                ->has('submissions')
            );
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