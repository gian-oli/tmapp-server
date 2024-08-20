<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    use ResponseTrait;

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
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure the email is valid and unique
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required_with:password|string|min:6',
            'role_id' => 'required|exists:roles,id', // Ensures role_id exists in the roles table
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'username.string' => 'Username must be a string.',
            'username.max' => 'Username cannot exceed 255 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'The email has already been taken.', // Ensures email is unique
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password_confirmation.required_with' => 'Password confirmation is required when password is provided.',
            'password_confirmation.string' => 'Password confirmation must be a string.',
            'password_confirmation.min' => 'Password confirmation must be at least 6 characters long.',
            'role_id.required' => 'Role is required.',
            'role_id.exists' => 'The selected role is invalid.', // Ensures the role exists
        ];
    }

    public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 422));  // 422 Unprocessable Entity status code
    }
}
