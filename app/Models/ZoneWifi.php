<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
