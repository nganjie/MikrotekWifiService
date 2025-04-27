<?php

namespace App\Http\Requests;

use App\Enum\PakageEnum;
use App\Enum\PakageTypeEnum;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreatePakageRequest extends FormRequest
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
            'type'=>['required',new Enum(PakageTypeEnum::class)],
            'name'=>['required','string'],
            'fixed_charge'=>['numeric'],
            'sms_charge'=>['numeric'],
            'percent_charge'=>['numeric','required_if:type,'.PakageTypeEnum::UNIT->label()],
            'min_limit'=>['numeric','required'],
        ];
    }
}
