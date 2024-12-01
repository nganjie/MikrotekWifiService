<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PayementGateway extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable=[
        'site_id',
        'secret_key',
        'api_key',
        'url'
    ];
}
