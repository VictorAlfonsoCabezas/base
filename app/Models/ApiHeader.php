<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiHeader extends Model
{
    protected $table = 'api_header';
    protected $fillable = [
        'id',
        'company_id',
        'type_api',
        'tipo_consulta',
        'date_created',
        'description',
        'table_name',
        'api_link',
        'need_table',
        'instancia',
        'token',
        'method',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
