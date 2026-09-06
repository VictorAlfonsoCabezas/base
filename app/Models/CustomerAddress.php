<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer_address';
    protected $fillable = [
        'id',
        'company_id',
        'customer_id',
        'text',
        'country_id',
        'region_id',
        'city_id',
        'latitud',
        'longitud',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
}
