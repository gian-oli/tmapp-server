<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SwimlaneRequest extends FormRequest
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
            'swimlane_name' => 'required|string',
            'project_id' => 'required|integer|exists:projects,id',
        ];
    }

    public function messages()
    {
        return [
            'swimlane_name.required' => 'Name is required',
            'project_id.required' => 'Project ID is required',
            'project_id.exists' => 'The selected project does not exist.',
        ];
    }

    public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 422));  // 422 Unprocessable Entity status code
    }
}
