<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class EmailController extends Controller {

    public static function newEmail($email, $cuerpo) {
        $path = 'img/encabezado.png';
        $man = file_get_contents(public_path($path));
        $imagen = base64_encode($man);
        $data = [
            'nombre_empresa' => 'INTÉLHO',
            'fecha' => date('Y-m-d H:i:s'),
            'imagen' => $imagen,
            'usuario' => $cuerpo,
            'password' => 'nuevo',
        ];
        Mail::to($email)->send(new NotificationMail($data));
        return true;
    }

}
