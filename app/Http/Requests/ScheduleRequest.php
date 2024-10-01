<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
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
            'name' => 'required|string',
            'status' => 'required|string',
            'percent_completed' => 'nullable|string',
            'plan_start_date' => 'nullable|string',
            'plan_end_date' => 'nullable|string',
            'plan_no_of_days' => 'nullable|string',
            'actual_start_date' => 'nullable|string',
            'actual_end_date' => 'nullable|string',
            'actual_no_of_days' => 'nullable|string',
            'gantt_chart_id' => 'required'
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
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'status.string' => 'The status must be a valid string.',
            'percent_completed.string' => 'The percent completed must be a valid string.',
            'plan_start_date.string' => 'The plan start date must be a valid string.',
            'plan_end_date.string' => 'The plan end date must be a valid string.',
            'plan_no_of_days.string' => 'The plan number of days must be a valid string.',
            'actual_start_date.string' => 'The actual start date must be a valid string.',
            'actual_end_date.string' => 'The actual end date must be a valid string.',
            'actual_no_of_days.string' => 'The actual number of days must be a valid string.',
            'gantt_chart_id.required' => 'The Gantt chart ID is required.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
