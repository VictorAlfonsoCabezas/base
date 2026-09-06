<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    protected $table = "usuario_rol";
    protected $fillable = ['rol_id', 'user_id', 'status'];
}
