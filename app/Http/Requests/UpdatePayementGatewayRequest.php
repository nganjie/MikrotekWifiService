<?php

namespace App\Http\Requests;

use App\Enum\PayementGatewayTypeEnum;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdatePayementGatewayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>[new Enum(PayementGatewayTypeEnum::class)],
            'is_active'=>['boolean'],
            'site_id'=>['string'],
            'secret_key'=>['string'],
            'api_key'=>['string'],
            'url'=>['string']
        ];
    }
}
