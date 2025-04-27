<?php

namespace App\Enum;

enum PayementGatewayTypeEnum:string
{
    case CINETPAY='cinetpay';
    case CAMPAY ='campay';
    public function label(): string
    {
        return match ($this) {
            self::CINETPAY=>'cinetpay',
            self::CAMPAY=>'campay',
        };
    }
}
