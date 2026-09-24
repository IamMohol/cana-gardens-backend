<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
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
            'name'             => ['required', 'string', 'min:2', 'max:150'],
            'email'            => ['required', 'string', 'email:filter', 'max:150'],
            'phone'            => ['required', 'string', 'min:8', 'max:50'],
            'event_type'       => ['nullable', 'string', 'max:100'],
            'event_date'       => ['nullable', 'date'],
            'guest_count'      => ['nullable', 'integer', 'min:1', 'max:5000'],
            'estimated_guests' => ['nullable', 'integer', 'min:1', 'max:5000'],
            'message'          => ['required', 'string', 'min:10', 'max:3000'],
            // Spam protection honeypots (must remain empty for human submissions)
            'website'          => ['nullable', 'string'],
            'bot_check'        => ['nullable', 'string'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'Please provide your full name.',
            'name.min'          => 'Your name must be at least 2 characters.',
            'email.required'    => 'Please provide a valid email address so we can reply.',
            'email.email'       => 'The email address format is invalid.',
            'phone.required'    => 'Please provide a contact phone number.',
            'phone.min'         => 'The phone number must be at least 8 digits.',
            'message.required'  => 'Please include details about your event or inquiry.',
            'message.min'       => 'Your message should be at least 10 characters long.',
            'website.max'       => 'Spam detected.',
            'bot_check.max'     => 'Spam detected.',
        ];
    }

    /**
     * Handle failed validation to return structured JSON.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'The provided information was incomplete or invalid.',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
