<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorEspecialidad extends Model
{
    protected $table = 'doctor_especialidad';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'doctor_id',
        'especialidad_id',
        'description',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }
    public function especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad', 'especialidad_id');
    }
}
