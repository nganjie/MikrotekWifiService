<?php

namespace App\Enum;

enum StateEnum :string
{
    case ACTIVE='active';
    case SUCCESS='success';
    case USE='use';
    case DESACTIVE='deactive';
    case DELETED='deleted';
    case PENDING='pending';
    case PROGRESSE='progress';
    case FAILED='failed';
    case COLLECTED='collected';
    case REJECTED='rejected';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE=>'active',
            self::SUCCESS=>'success',
            self::USE=>'use',
            self::DESACTIVE=>'deactive',
            self::PENDING=>'pending',
            self::FAILED=>'failed',
            self::PROGRESSE=>'progress',
            self::DELETED=>'deleted',
            self::COLLECTED=>'collected',
            self::REJECTED=>'rejected'
        };
    }
}

