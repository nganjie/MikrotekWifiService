<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PakageWifi extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'zone_wifi_id',
        'designation',
        'description',
        'price'
    ];
    public function tickets():HasMany{
        return $this->hasMany(TicketWifi::class);
    }
    public function zoneWifis():BelongsTo{
        return $this->belongsTo(ZoneWifi::class,'zone_wifi_id');
    }
}
