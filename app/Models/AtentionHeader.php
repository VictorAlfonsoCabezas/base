<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtentionHeader extends Model
{
    protected $table = 'atention_header';
    protected $fillable = [
        'id',
        'company_id',
        'customer_id',
        'sede_id',
        'departament_id',
        'doctor_id',
        'date_created',
        'date_opening',
        'date_atention',
        'oda',
        'generation_area_id',
        'generation_area_name',
        'generation_area_externa',
        'date_order',
        'reservado_1',
        'reservado_2',
        'observation',
        'status_atention',
        'status_pay',
        'code_intel', //doc_motivo en INtelho
        'type_send',
        'sincronizado',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }
    public function departament()
    {
        return $this->belongsTo('App\Models\Departament', 'departament_id');
    }
    public function departamentGenera()
    {
        return $this->belongsTo('App\Models\Departament', 'generation_area_id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }
}
