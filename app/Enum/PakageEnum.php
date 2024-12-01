<?php

namespace App\Enum;

enum PakageEnum:string
{
    case FIXEDCHARGE='fixed_charge';
    case PERCENTCHARGE='percent_charge';
    case PENDING='pending';
    case PROGRESSE='progress';
    case FAILED='failed';
    public function label(): string
    {
        return match ($this) {
            self::FIXEDCHARGE => 'fixed_charge',
            self::PERCENTCHARGE => 'percent_charge',
            self::PENDING=>'pending',
            self::FAILED=>'failed',
            self::PROGRESSE=>'progress'
        };
    }
}
