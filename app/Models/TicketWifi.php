<?php

namespace App\Models;

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
    public function pakageWifi():BelongsTo{
        return $this->belongsTo(PakageWifi::class);
    }
    public function transaction():HasOne{
        return $this->hasOne(Transaction::class);
    }
}
