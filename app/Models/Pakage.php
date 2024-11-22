<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPakage
 */
class Pakage extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'admin_id',
        'type',
        'name',
        'fixed_charge',
        'percent_charge',
        'min_limit',
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'admin_id');
    }
}
