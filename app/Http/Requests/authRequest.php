<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class authRequest extends FormRequest
{
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
            "email"=>['required','email','exists:users,email'],
            "password"=>['required']
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(ApiResponse::error('erreur de validation',$validator->errors()));
    }
}
