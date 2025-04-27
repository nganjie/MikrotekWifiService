<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
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
    public function scopeCurrent(Builder $query,string|null $user){
        $user_id=$user?$user:Auth::user()->id;
        return $query->whereRelation('zoneWifis','user_id',$user_id);
    }
    public function scopeZoneWifi(Builder $query,string|null $zone_wifi){
        if(!$zone_wifi)return $query;
        return $query->whereRelation('zoneWifis','id',$zone_wifi);
    }
    public function tickets():HasMany{
        return $this->hasMany(TicketWifi::class);
    }
    public function zoneWifis():BelongsTo{
        return $this->belongsTo(ZoneWifi::class,'zone_wifi_id');
    }
}
