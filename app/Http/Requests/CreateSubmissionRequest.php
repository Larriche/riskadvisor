<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_ids' => 'required|exists:insurance_products,id',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'contact_preference' => ['required', Rule::in(['phone', 'email'])],
            'city' => 'required',
            'state_id' => 'required|exists:states,id',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
        ];
    }

    public function messages()
    {
        return [
            'product_ids.required' => 'Please select a product offering',
            'first_name.required' => 'Please enter your first name',
            'last_name.required' => 'Please enter your last name',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please provide a valid email',
            'phone.required' => 'Please enter your phone',
            'phone' => 'Please enter a valid US phone',
            'city.required' => 'Please enter your city',
            'state_id.required' => 'Please select your state',
            'zipcode' => 'Please enter a valid zipcode',
        ];
    }
}