<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
