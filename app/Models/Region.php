<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';
    protected $fillable = [
        'id',
        'country_id',
        'name',
        'code',
        'status'
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
