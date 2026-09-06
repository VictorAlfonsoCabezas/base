<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiDetail extends Model
{
    protected $table = 'api_detail';
    protected $fillable = [
        'id',
        'company_id',
        'api_header_id',
        'date_created',
        'description',
        'column_name',
        'alias',
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
