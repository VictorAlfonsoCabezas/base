<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SendDetail;
use Response;

class ApiStorage extends Controller {

    public static function saveFile($detalle, $file) {
//        if (!file_exists(config('constants.ROUTES.PATH_FILE'))) {
//            mkdir(config('constants.ROUTES.PATH_FILE'), 0777, true);
//        }
//        if (!file_exists(config('constants.ROUTES.PATH_FILE_ORDER'))) {
//            mkdir(config('constants.ROUTES.PATH_FILE_ORDER'), 0777, true);
//        }
        $detail = SendDetail::find($detalle->id);
        if ($detalle->file_complete !== null) {
            $file = $request->file('file_complete');
            $nombre = time() . '.' . $file->getClientOriginalExtension();
            $destino = public_path('public_image/ordenes');
            $request->photo->move($destino, $nombre);
            $detail->file = true;
            $detail->file_path = $destino;
            $detail->file_name = $nombre;
            $detail->file_extension = $file->getClientOriginalExtension();
            $detail->save();
        }
    }

}
