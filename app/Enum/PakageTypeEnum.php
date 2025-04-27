<?php

namespace App\Enum;

enum PakageTypeEnum:string
{
    case MONTH='month';
    case UNIT='unit';
    public function label(): string
    {
        return match ($this) {
            self::MONTH => 'month',
            self::UNIT => 'unit',
        };
    }
}
