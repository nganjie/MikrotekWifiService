<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPakageUser
 */
class PakageUser extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'user_id',
        'pakage_id',
        'status',
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function pakage():BelongsTo{
        return $this->belongsTo(Pakage::class);
    }

}
