<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassiveHeader extends Model {

    protected $table = 'massive_header';
    protected $fillable = [
        'id',
        'company_id',
        'code',
        'bot_header_id',
        'date_created',
        'hour_created',
        'user_create',
        'user_name',
        'status',
    ];

}
