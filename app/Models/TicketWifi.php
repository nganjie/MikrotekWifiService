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
 * @mixin IdeHelperTicketWifi
 */
class TicketWifi extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'zone_wifi_id',
        'username',
        'password',
        'profile',
        'time_limit',
        'data_limit',
        'comment',
        'state'
    ];
    public function scopeCurrent(Builder $query,string|null $user){
        $user_id=$user?$user:Auth::user()->id;
        return $query->whereRelation('pakageWifi.zoneWifis','user_id',$user_id);
    }
    public function pakageWifi():BelongsTo{
        return $this->belongsTo(PakageWifi::class);
    }
    public function transaction():HasMany{
        return $this->hasMany(Transaction::class);
    }
}
