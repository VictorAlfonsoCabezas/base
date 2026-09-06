<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiParameters extends Model
{
    protected $table = 'api_parameters';
    protected $fillable = [
        'id',
        'company_id',
        'api_header_id',
        'date_created',
        'description',
        'type',
        'name',
        'default_value',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function apiHeader()
    {
        return $this->belongsTo('App\Models\ApiHeader', 'api_header_id');
    }
}
