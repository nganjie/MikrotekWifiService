<?php

namespace App\Http\Requests;

use App\Enum\PayementGatewayTypeEnum;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreatePayementGatewayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->is_admin;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required',new Enum(PayementGatewayTypeEnum::class)],
            'site_id'=>['required','string'],
            'secret_key'=>['required','string'],
            'api_key'=>['required','string'],
            'url'=>['required','string']
        ];
    }
}
