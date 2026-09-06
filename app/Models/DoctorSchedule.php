<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $table = 'doctor_schedule';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'doctor_id',
        'doctor_name',
        'hour_start',
        'hour_end',
        'day',
        'date_total',
        'interval',
        'sede_id',
        'sede_name',
        'departament_id',
        'departament_name',
        'code_intel',
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
    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }
    public function departament()
    {
        return $this->belongsTo('App\Models\Departament', 'departament_id');
    }
}
