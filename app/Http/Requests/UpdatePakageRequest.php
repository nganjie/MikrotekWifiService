<?php

namespace App\Http\Requests;

use App\Enum\PakageEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdatePakageRequest extends FormRequest
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
            'type'=>[new Enum(PakageEnum::class)],
            'name'=>['string'],
            'fixed_charge'=>['required_if:type,'.PakageEnum::FIXEDCHARGE->label()],
            'percent_charge'=>['required_if:type,'.PakageEnum::PERCENTCHARGE->label()],
            'min_limit'=>['numeric'],
        ];
    }
}
