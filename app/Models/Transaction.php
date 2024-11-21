<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    protected $fillable=[
        'ticket_wifi_id',
        'money_withdrawal_id',
        'type',
        'status',
        'receiver_number',
        'price',
        'charge',
        'sms_charge',
        'net_price',
        'vendor_reference',
        'operation_reference',
        'is_collected',
    ];
    public function ticketWifi():BelongsTo{
        return $this->belongsTo(TicketWifi::class);
    }
    public function moneyWithdrawal():BelongsTo{
        return $this->belongsTo(MoneyWithdrawal::class);
    }
}
