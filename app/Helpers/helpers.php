<?php

use App\Models\Admin\Permiso;
use Illuminate\Database\Eloquent\Builder;

if (!function_exists('getMenuActivo')) {
    function getMenuActivo($ruta) {
        if (('/' . request()->path()) == $ruta) {
            return 'active';
        } else {
            return '';
        }
    }
}