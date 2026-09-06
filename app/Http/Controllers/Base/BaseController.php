<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class BaseController extends Controller
{

    public static function GenerarTokenInterno($longitud)
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        do {
            $max = strlen($pattern) - 1;
            for ($i = 0; $i < $longitud; $i++) {
                $key .= strtoupper($pattern[rand(0, $max)]);
                // $key .= strtoupper($pattern[rand(0, $max)]);
            }
        } while (Company::where('token_interno', $key)->count() > 0);
        return $key;
    }
    public static function GenerarInstancia($longitud)
    {
        $key = '';
        $pattern = '1234567890';
        do {
            $max = strlen($pattern) - 1;
            for ($i = 0; $i < $longitud; $i++) {
                $key .= strtoupper($pattern[rand(0, $max)]);
            }
        } while (Company::where('instancia_interno', $key)->count() > 0);
        return $key;
    }
}
