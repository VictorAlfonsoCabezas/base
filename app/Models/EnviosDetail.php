<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnviosDetail extends Model
{
    protected $table = 'envios_detail';
    protected $fillable = [
        'id',
        'date_created',
        'company_id',
        'customer_id',
        'envios_header_id',
        'phone',
        'mensaje',
        'estado_envio',
        'date_enviado',
        'time_enviado',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function enviosHeader()
    {
        return $this->belongsTo('App\Models\EnviosHeader', 'envios_header_id');
    }
}
