<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ApiSigcenter extends Controller
{
    public function guardarEmpresa(Request $request)
    {
        $company = Company::where('code_intel', $request->input('code_intel'));
        if ($company->count() > 0) {
            $company = Company::where('code_intel', $request->input('code_intel'))->first();
        } else {
            $company = new Company;
        }
        $company->code_intel = $request->input('code_intel');
        $company->ruc = $request->input('ruc');
        $company->company_name = $request->input('name');
        $company->comercial_name = $request->input('name');
        $company->company_color = ($request->input('color') !== 'vacio') ? $request->input('color') : '';
        $company->phone = $request->input('phone');
        $company->email = $request->input('email');
        $company->status = $request->input('status');
        $company->save();
        $data = [
            'code' => 200,
            'msg' => 'ok',
        ];
        return json_encode($data);
    }

    public function guardarSede(Request $request)
    {
        $sede = Sede::where('code_intel', $request->input('code_intel'));
        $company = Company::where('code_intel', $request->input('code_intel_empresa'))->first();
        if ($sede->count() > 0) {
            $sede = Sede::where('code_intel', $request->input('code_intel'))->where('company_id', $company->id)->first();
        } else {
            $sede = new Sede;
        }
        $sede->company_id = $company->id;
        $sede->date_created = date('Y-m-d');
        $sede->principal = $request->input('principal');
        $sede->name = $request->input('name');
        $sede->code_intel = $request->input('code_intel');
        $sede->city_id = $request->input('city_id');
        $sede->latitud = $request->input('latitud');
        $sede->longitud = $request->input('longitud');
        $sede->status = $request->input('status');
        $sede->save();
        $data = [
            'code' => 200,
            'msg' => 'ok',
        ];
        return json_encode($data);
    }

    public function showCity()
    {
        $existe = City::where('status', true)->get();
        if($existe->count()){
            $ciudades = City::where('status', true)->get();
            $data = [
                'code' => 200,
                'msg' => 'ok',
                'data' => $ciudades,
            ];
        }else{
            $data = [
                'code' => 400,
                'msg' => 'no data',
                'data' => false,
            ];
        }
        return $data;
    }
}
