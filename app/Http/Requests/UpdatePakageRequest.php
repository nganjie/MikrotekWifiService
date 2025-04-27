<?php

namespace App\Http\Requests;

use App\Enum\PakageEnum;
use App\Enum\PakageTypeEnum;
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
            'type'=>[new Enum(PakageTypeEnum::class)],
            'name'=>['string'],
            'fixed_charge'=>['numeric'],
            'percent_charge'=>['required_if:type,'.PakageTypeEnum::UNIT->label()],
            'min_limit'=>['numeric'],
        ];
    }
}
