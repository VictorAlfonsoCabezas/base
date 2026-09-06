<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAffiliation extends Model
{
    protected $table = 'type_affiliation';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'name',
        'publico',
        'code_intel',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
