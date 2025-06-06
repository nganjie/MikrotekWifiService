<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperZoneWifi
 */
class ZoneWifi extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'user_id',
        'name',
        'captive_gate',
        'description',
        'image',
        'wallet',
        'city',
        'message',
        'is_active_sms',
    ];
    public function scopeCurrent(Builder $query,string|null $user){
        $user_id=$user?$user:Auth::user()->id;
        return $query->whereRelation('user','id',$user_id);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function pakageWifis():HasMany{
        return $this->hasMany(PakageWifi::class,'zone_wifi_id');
    }
    public function captivePortail():HasOne{
        return $this->hasOne(CaptivePortail::class);
    }
}
