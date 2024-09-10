<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'finished_at' => 'nullable|date|after_or_equal:due_date',
            'assigned_by' => 'nullable|string',
            'user_id' => [
                'nullable',
                'exists:users,id',
                Rule::exists('team_members', 'user_id')->where(function ($query) {
                    return $query->where('project_id', $this->input('project_id'));
                }),
            ],
            'swimlane_id' => 'nullable|exists:swimlanes,id',
            'priority_id' => 'required|exists:priorities,id',
            'column_id' => 'nullable|exists:columns,id',
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
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            
            'description.string' => 'The description must be a string.',
            
            'due_date.date' => 'The due date must be a valid date.',
            
            'finished_at.date' => 'The finished at date must be a valid date.',
            'finished_at.after_or_equal' => 'The finished at date must be a date after or equal to the due date.',
            
            'assigned_by.string' => 'The assigned by field must be a string.',
            
            'user_id.exists' => 'The selected user is invalid or not a member of the specified project.',
            
            'swimlane_id.exists' => 'The selected swimlane does not exist.',
            
            'priority_id.required' => 'The priority ID is required.',
            'priority_id.exists' => 'The priority ID must exist in the priorities table.',
            
            'column_id.required' => 'The column ID is required.',
            'column_id.exists' => 'The column ID must exist in the columns table.',
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
        throw new HttpResponseException(response()->json($response, 422)); // 422 Unprocessable Entity
    }
}
