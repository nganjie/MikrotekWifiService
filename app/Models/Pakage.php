<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPakage
 */
class Pakage extends Model
{
    protected $fillable=[
        'admin_id',
        'type',
        'name',
        'fixed_charge',
        'percent_charge',
        'min_limit',
    ];
}
