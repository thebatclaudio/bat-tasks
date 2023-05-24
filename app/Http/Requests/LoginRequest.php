<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required|string"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();

        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'errors' => $errors,
            ], 422)
        );
    }
}
