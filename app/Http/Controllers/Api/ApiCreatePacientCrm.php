<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Response;

class ApiCreatePacientCrm extends Controller
{
    public function createPacientCrm(Request $request)
    {
        $data = [
            "name" => strtoupper($request->input('nombres') . ' ' . $request->input('apellidos')),
            "nombres" => strtoupper($request->input('nombres')),
            "apellidos" => strtoupper($request->input('apellidos')),
            "numero_documento" => $request->input('identification'),
            "direccion" => strtoupper($request->input('address')),
            "birth_date" => $request->input('birth_date'),
            "sex" => $request->input('sex'),
            "celular_1" => $request->input('celular'),
            "correo" => $request->input('email'),
            "company_id" => 1
        ];
        if (Customer::create($data)) {
            $data = [
                'code' => 200,
                'msg' => 'Cliente Almacenado...',
            ];
            return json_encode($data);
        } else {
            $data = [
                'code' => 500,
                'msg' => 'No almacenado...',
            ];
            return json_encode($data);
        }
    }
}
