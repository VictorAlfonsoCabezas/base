<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedures extends Model
{
    protected $table = 'procedures';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'code_intel',
        'name',
        'code_intel_type',
        'type_name',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
