<?php

namespace App\Http\Requests;

use App\Enum\GroupByEnum;
use App\Enum\PeriodEnum;
use App\Enum\StateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class DashboardRequest extends FormRequest
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
            'user_id'=>['required','exists:users,id'],
            'zone_wifi'=>['exists:zone_wifis,id','nullable'],
            'pakage_wifi'=>['exists:pakage_wifis,id','nullable'],
            'group_by'=>[new Enum(GroupByEnum::class),'nullable'],
            'status'=>[new Enum(StateEnum::class),'nullable'],
            "period"=>[new Enum(PeriodEnum::class),'nullable'],
            "start_date"=>["required_if:period,".PeriodEnum::CustomPeriod->label(),'nullable'],
            "end_date"=>["required_if:period,".PeriodEnum::CustomPeriod->label(),'nullable']
        ];
    }
}
