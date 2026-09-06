<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sede;

class Company extends Model
{

    protected $table = 'company';
    protected $fillable = [
        'id',
        'principal',
        'code_intel',
        'ruc',
        'company_name',
        'company_color',
        'comercial_name',
        'company_description',
        'legal_representative',
        'address',
        'phone',
        'email',
        'photo',
        'url',
        'conexion',
        'imprimir_comprobantes',
        'ip',
        'latitud',
        'longitud',
        'electronica',
        'contribuyente_especial',
        'obligado_contabilidad',
        'hora_inicio',
        'hora_fin',
        'twilio_principal',
        'instancia_interno',
        'token_interno',
        'instancia',
        'token_interno',
        'plan_id',
        'plan_status',
        'whatsapp_conexion',
        'status'
    ];

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }
}
