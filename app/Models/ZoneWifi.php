<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperZoneWifi
 */
class ZoneWifi extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'captive_gate',
        'description',
        'image',
        'message',
        'is_active_sms',
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function tickets():HasMany{
        return $this->hasMany(TicketWifi::class);
    }
    public function captivePortail():HasOne{
        return $this->hasOne(CaptivePortail::class);
    }
}
