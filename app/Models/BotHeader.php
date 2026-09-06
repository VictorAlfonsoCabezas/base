<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotHeader extends Model
{
    protected $table = 'bot_header';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'name',
        'description',
        'start_code',
        'home_codigo',
        'home_texto',
        'back_codigo',
        'back_texto',
        'calcular_sede_proxima',
        'bot_conection_id',
        'user_created_id',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function userCreated()
    {
        return $this->belongsTo('App', 'userCreated');
    }
}
