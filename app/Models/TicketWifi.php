<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperTicketWifi
 */
class TicketWifi extends Model
{
    protected $fillable=[
        'zone_wifi_id',
        'password',
        'profile',
        'time_limit',
        'data_limit',
        'comment',
    ];
    public function ZoneWifi():BelongsTo{
        return $this->belongsTo(ZoneWifi::class);
    }
    public function transactions():HasMany{
        return $this->hasMany(Transaction::class);
    }
}
