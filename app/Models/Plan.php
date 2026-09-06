<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model {

    protected $table = 'plan';
    protected $fillable = [
        'id',
        'name',
        'month_price',
        'year_price',
        'color_1',
        'color_2',
        'color_3',
        'status'
    ];
}
