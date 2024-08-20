<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization as needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority_id' => 'required|exists:priorities,id', // Use priority_id and validate existence
            'user_id' => [
                'required',
                'exists:users,id',
                "exists:team_members,user_id,project_id,{$this->input('project_id')}",
            ],
            'project_id' => 'required|exists:projects,id',
            'assigned_by' => 'nullable|string', // Assuming this should be included based on the migration
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
            'description.string' => 'The description must be a string.',
            'due_date.date' => 'The due date must be a valid date.',
            'priority_id.required' => 'The priority ID is required.',
            'priority_id.exists' => 'The priority ID must exist in the priorities table.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user is not a member of the specified project.',
            'project_id.required' => 'The project ID is required.',
            'project_id.exists' => 'The project ID must exist in the projects table.',
            'assigned_by.string' => 'The assigned by field must be a string.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
