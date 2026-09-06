<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MspCookies extends Model
{
    protected $table = 'msp_cookies';
    protected $fillable = [
        'id',
        'date_created',
        'sesion',
        'cookie',
        'citrix_ns_id',
        'citrix_wat',
        'citrix_wlf',
        'date_expired'
    ];
}
