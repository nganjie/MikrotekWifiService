<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCaptivePortail
 */
class CaptivePortail extends Model
{
    protected $fillable=[
        'zone_wifi_id',
        'code',
    ];
}
