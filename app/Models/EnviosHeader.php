<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnviosHeader extends Model
{
    protected $table = 'envios_header';
    protected $fillable = [
        'id',
        'envio_ahora',
        'company_id',
        'code_intel',
        'date_created',
        'description',
        'tipo',
        'estado_envio',
        'cantidad_destinos',
        'mensaje_defecto',
        'envio_inmediato',
        'envio_programado',
        'date_programado',
        'time_programado',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
