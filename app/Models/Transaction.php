<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'ticket_wifi_id',
        'money_withdrawal_id',
        'type',
        'status',
        'receiver_number',
        'price',
        'charge',
        'sms_charge',
        'is_send_sms',
        'net_price',
        'vendor_reference',
        'operation_reference',
        'is_collected',
    ];
    public function ticketWifi():BelongsTo{
        return $this->belongsTo(TicketWifi::class);
    }
    public function scopeCurrent(Builder $query,User $user){
        return $query->whereRelation('ticketWifi.pakageWifi.zoneWifis','user_id',$user->id);
    }
    public function scopeStatistique(Builder $query,User $user){
        return $query->whereRelation('ticketWifi.pakageWifi.zoneWifis','user_id',$user->id);
    }
    public function scopeZoneWifi(Builder $query,$zone_wifi){
        return $query->whereRelation('ticketWifi.pakageWifi.zoneWifis','id',$zone_wifi);
    }
    public function scopePakageWifi(Builder $query,$pakage_wifi){
        return $query->whereRelation('ticketWifi.pakageWifi','id',$pakage_wifi);
    }
    public function moneyWithdrawal():BelongsTo{
        return $this->belongsTo(MoneyWithdrawal::class);
    }
    public function scopeFilterByPeriod($query, $period, $customStart = null, $customEnd = null)
{
    $start = null;
    $end = null;

    switch ($period) {
        case 'Today':
            $start = Carbon::today();
            $end = Carbon::today()->endOfDay();
            break;

        case 'Yesterday':
            $start = Carbon::yesterday();
            $end = Carbon::yesterday()->endOfDay();
            break;

        case 'ThisWeek':
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
            break;

        case 'ThisMonth':
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            break;

        case 'PreviousMonth':
            $start = Carbon::now()->subMonth()->startOfMonth();
            $end = Carbon::now()->subMonth()->endOfMonth();
            break;

        case 'ThisTrimester':
            $month = Carbon::now()->month;
            $startMonth = floor(($month - 1) / 3) * 3 + 1;
            $start = Carbon::createFromDate(null, $startMonth, 1)->startOfMonth();
            $end = (clone $start)->addMonths(2)->endOfMonth();
            break;

        case 'ThisSemester':
            $month = Carbon::now()->month;
            $startMonth = $month <= 6 ? 1 : 7;
            $start = Carbon::createFromDate(null, $startMonth, 1)->startOfMonth();
            $end = (clone $start)->addMonths(5)->endOfMonth();
            break;

        case 'ThisYear':
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            break;

        case 'PreviousYear':
            $start = Carbon::now()->subYear()->startOfYear();
            $end = Carbon::now()->subYear()->endOfYear();
            break;

        case 'CustomPeriod':
            if ($customStart && $customEnd) {
                $start = Carbon::parse($customStart)->startOfDay();
                $end = Carbon::parse($customEnd)->endOfDay();
                //dd([$start,$end]);
            }
            break;
    }

    if ($start && $end) {
        return $query->whereBetween('transactions.created_at', [$start, $end]);
    }

    return $query;
}
}
