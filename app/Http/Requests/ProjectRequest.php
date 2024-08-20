<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjectRequest extends FormRequest
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
            'goal' => 'required|string|max:255',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'priority_id' => 'required|exists:priorities,id'
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
            'goal.required' => 'The project goal is required.',
            'goal.string' => 'The project goal must be a string.',
            'goal.max' => 'The project goal cannot exceed 255 characters.',
            'deadline.required' => 'The deadline is required.',
            'deadline.date' => 'The deadline must be a valid date.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The user ID must exist in the users table.',
            'priority_id.required' => 'The priority ID is required.',
            'priority_id.exists' => 'The priority ID must exist in the users table.',
        ];
    }

    public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
