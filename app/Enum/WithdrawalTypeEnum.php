<?php

namespace App\Enum;

enum WithdrawalTypeEnum:string
{
    case ACTIVE='active';
    case PENDING='pending';
    case COLLECTED='collected';
    case REJECTED='rejected';
    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'active',
            self::PENDING => 'pending',
            self::COLLECTED=>'collected',
            self::REJECTED=>'rejected'
        };
    }
}
