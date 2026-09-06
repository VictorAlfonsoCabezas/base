<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtentionMedicine extends Model
{
    protected $table = 'atention_medicine';
    protected $fillable = [
        'id',
        'company_id',
        'atention_header_id',
        'medicine_id',
        'medicine_name',
        'date_created',
        'dosis',
        'observation',
        'total',
        'status_dispatched',
        'reservado_1',
        'reservado_2',
        'code_intel',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function atentionHeader()
    {
        return $this->belongsTo('App\Models\AtentionHeader', 'atention_header_id');
    }
    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine', 'medicine_id');
    }
}
