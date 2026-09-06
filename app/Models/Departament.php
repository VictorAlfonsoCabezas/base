<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departament';
    protected $fillable = [
        'id',
        'company_id',
        'sede_id',
        'date_created',
        'name',
        'code_intel',
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
