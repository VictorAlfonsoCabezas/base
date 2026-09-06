<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwilioCredenciales extends Model
{
    protected $table = 'twilio_credenciales';
    protected $fillable = [
        'id',
        'principal',
        'company_id',
        'sede_id',
        'date_created',
        'sid',
        'token',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }
}
