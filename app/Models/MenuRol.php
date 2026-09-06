<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRol extends Model {

    protected $table = "menu_rol";
    protected $fillable = ['rol_id', 'menu_id'];

    public function menu() {
        return $this->belongsTo('App\Models\Admin\Menu', 'menu_id');
    }

}
