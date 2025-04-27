<?php

namespace App\Enum;

enum PeriodEnum:string
{
   case Today = 'Today';
   case Yesterday = 'Yesterday';
   case  ThisWeek = 'ThisWeek';
   case  ThisMonth = 'ThisMonth';
   case PreviousMonth = 'PreviousMonth';
   case ThisTrimester = 'ThisTrimester';
   case  ThisSemester = 'ThisSemester';
   case  ThisYear = 'ThisYear';
   case  PreviousYear = 'PreviousYear';
   case  CustomPeriod = 'CustomPeriod';
    public function label(): string
    {
        return match ($this) {
            self::Today => 'Today',
            self::Yesterday => 'Yesterday',
            self::ThisWeek=>'ThisWeek',
            self::ThisMonth=>'ThisMonth',
            self::PreviousMonth=>'PreviousMonth',
            self::ThisTrimester=>'ThisTrimester',
            self::ThisYear=>'ThisYear',
            self::PreviousYear=>'PreviousYear',
            self::CustomPeriod=>'CustomPeriod',
        };
    }
}
