<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MachineMindray;
use Response;

class ApiColoneal extends Controller {

    public function saveMindray3000(Request $request) {

        $machine = New MachineMindray();
        $machine->date = $request->input('text_identifier');
        $machine->date_created = date('Y-m-d');
        $machine->save();

        $data = [
            'code' => 200,
            'msg' => 'Se guardo correctamente la informacion',
            'data' => $request->all()
        ];
        return Response::json($data);
    }

}
