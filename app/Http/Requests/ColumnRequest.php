<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ColumnRequest extends FormRequest
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
    public function rules()
    {
        return [
            'column_name' => 'required|string',
            'swimlane_id' => 'required|integer|exists:swimlanes,id',
        ];
    }

    public function messages()
    {
        return [
            'column_name.required' => 'Column name is required.',
            'swimlane_id.required' => 'Swimlane ID is required.',
            'swimlane_id.exists' => 'The selected swimlane does not exist.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 422));  // 422 Unprocessable Entity status code
    }
}
