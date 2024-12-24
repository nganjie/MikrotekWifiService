<?php

namespace App\Enum;

enum StateEnum :string
{
    case ACTIVE='active';
    case DESACTIVE='deactive';
    case DELETED='deleted';
    case PENDING='pending';
    case PROGRESSE='progress';
    case FAILED='failed';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE=>'active',
            self::DESACTIVE=>'deactive',
            self::PENDING=>'pending',
            self::FAILED=>'failed',
            self::PROGRESSE=>'progress',
            self::DELETED=>'deleted'
        };
    }
}

