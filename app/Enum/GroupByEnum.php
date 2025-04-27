<?php

namespace App\Enum;

enum GroupByEnum:string
{
   case Status = 'Status';
   case ZoneWifi = 'ZoneWifi';
   case  PakageWifi = 'PakageWifi';
    public function label(): string
    {
        return match ($this) {
            self::Status => 'Status',
            self::ZoneWifi => 'ZoneWifi',
            self::PakageWifi=>'PakageWifi',
        };
    }
}
