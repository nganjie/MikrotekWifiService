<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperCaptivePortail
 */
class CaptivePortail extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'zone_wifi_id',
        'code',
    ];
    public function ZoneWifi():BelongsTo{
        return $this->belongsTo(ZoneWifi::class);
    }
}
