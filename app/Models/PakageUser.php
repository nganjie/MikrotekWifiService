<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
