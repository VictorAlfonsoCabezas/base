<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineMindray extends Model {

    protected $table = 'machine_mindray';
    protected $fillable = [
        'id',
        'date',
        'date_created',
    ];

}
