<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customer';
    protected $fillable = [
        'id',
        'company_id',
        'sede_id',
        'company_assigned_id',
        'name',
        'nombres',
        'apellidos',
        'type_document',
        'numero_documento',
        'direccion',
        'parentesco_customer',
        'name_parentesco',
        'numero_identificacion_parentesco',
        'latitud',
        'longitud',
        'telefono',
        'celular_1',
        'celular_2',
        'celular_3',
        'correo',
        'birth_date',
        'customer_address_id',
        'nationality',
        'sex',
        'status',
    ];
    
    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    
    public function companyAssigned()
    {
        return $this->belongsTo('App\Models\Company', 'company_assigned_id');
    }
}
