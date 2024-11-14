<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEmail
 */
class Email extends Model
{
    protected $guarded=['id'];
    protected $fillable=[
        'first_name',
        'last_name',
        'subject',
        'email',
        'message'
    ];
}
