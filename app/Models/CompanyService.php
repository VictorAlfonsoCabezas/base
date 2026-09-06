<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model {

    protected $table = 'company_services';
    protected $fillable = [
        'id',
        'company_id',
        'service_id',
        'name',
        'status'
    ];

}
