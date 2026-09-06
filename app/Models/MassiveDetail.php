<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassiveDetail extends Model {

    protected $table = 'massive_detail';
    protected $fillable = [
        'id',
        'company_id',
        'code_header',
        'massive_header_id',
        'first_name',
        'second_name',
        'last_name',
        'surname',
        'sex',
        'citizenship_type',
        'citizenship_card',
        'birth_date',
        'phone',
        'phone2',
        'cellular',
        'email',
        'envios',
        'status',
    ];

}
