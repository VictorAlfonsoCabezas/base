<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    protected $table = 'affiliation';
    protected $fillable = [
        'id',
        'company_id',
        'type_affiliation_id',
        'name',
        'date_created',
        'percentage',
        'percentage_coverage',
        'code_intel',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function typeAffiliation()
    {
        return $this->belongsTo('App\Models\TypeAffiliation', 'type_affiliation_id');
    }
}
