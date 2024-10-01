<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PlanDateRequest extends FormRequest
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
            'date' => 'required|date|date_format:Y-m-d',
            'time_spent' => 'required|numeric',
            'schedule_id' => 'required'
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
            'date.required' => 'The date is required.',
            'date.date' => 'The date must be a valid date.',
            'date.date_format' => 'The date format must be Y-m-d.',
            'time_spent.required' => 'The time spent is required.',
            'time_spent.numeric' => 'The time spent must be a number.',
            'schedule_id.required' => 'The schedule id is required.',
            'schedule_id.integer' => 'The schedule id must be an integer.'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
