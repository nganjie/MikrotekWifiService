<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMoneyWithdrawal
 */
class MoneyWithdrawal extends Model
{
    protected $fillable=[
        'user_id',
        'status',
        'pakage_type',
        'receiver_number',
        'amount',
    ];
}
