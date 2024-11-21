<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPakageUser
 */
class PakageUser extends Model
{
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
