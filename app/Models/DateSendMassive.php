<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateSendMassive extends Model {

    protected $table = 'date_send_massive';
    protected $fillable = [
        'id',
        'company_id',
        'code_header',
        'massive_header_id',
        'date_created',
        'hour_created',
    ];

}
