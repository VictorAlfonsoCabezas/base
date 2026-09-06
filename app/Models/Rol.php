<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table = "rol";
    protected $fillable = [
        'nombre',
        'user_create',
        'observation',
        'menu_type',
        'status'
    ];
}
