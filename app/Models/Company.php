<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'instancia_interno',
        'token_interno',
        'instancia',
        'token_interno',
        'status'
    ];

}
