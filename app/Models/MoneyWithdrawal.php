<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function transactions():HasMany{
        return $this->hasMany(Transaction::class);
    }
}
