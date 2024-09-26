<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BatchTaskRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'tasks' => 'required|array',
            
            'tasks.*.title' => 'required|string',
            'tasks.*.description' => 'nullable|string',
            'tasks.*.color_name' => 'nullable|string',
            'tasks.*.start_date' => 'nullable|date',
            'tasks.*.due_date' => 'nullable|date',
            'tasks.*.finished_at' => 'nullable|date|after_or_equal:tasks.*.due_date',
            'tasks.*.assigned_by' => 'nullable|string',
            
            'tasks.*.user_id' => [
                'nullable',
                'exists:users,id',
                Rule::exists('team_members', 'user_id')->where(function ($query) {
                    return $query->where('project_id', $this->input('tasks.*.project_id'));
                }),
            ],
            
            'tasks.*.swimlane_id' => 'nullable|exists:swimlanes,id',
            'tasks.*.priority_id' => 'required|exists:priorities,id',
            'tasks.*.column_id' => 'nullable|exists:columns,id',
        ];
    }

    /**
     * Get the custom validation messages.
     */
    public function messages(): array
    {
        return [
            'tasks.*.title.required' => 'Each task must have a title.',
            'tasks.*.title.string' => 'The title must be a string.',
            
            'tasks.*.description.string' => 'The description must be a string.',
            'tasks.*.color_name.string' => 'The color name must be a string.',
            
            'tasks.*.start_date.date' => 'The start date must be a valid date.',
            'tasks.*.due_date.date' => 'The due date must be a valid date.',
            
            'tasks.*.finished_at.date' => 'The finished at date must be a valid date.',
            'tasks.*.finished_at.after_or_equal' => 'The finished at date must be after or equal to the due date.',
            
            'tasks.*.assigned_by.string' => 'The assigned by field must be a string.',
            
            'tasks.*.user_id.exists' => 'The selected user is invalid or not a member of the specified project.',
            
            'tasks.*.swimlane_id.exists' => 'The selected swimlane does not exist.',
            
            'tasks.*.priority_id.required' => 'The priority ID is required.',
            'tasks.*.priority_id.exists' => 'The priority ID must exist in the priorities table.',
            
            'tasks.*.column_id.exists' => 'The column ID must exist in the columns table.',
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
