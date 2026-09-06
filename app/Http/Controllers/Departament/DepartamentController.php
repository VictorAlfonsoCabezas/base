<?php

namespace App\Http\Controllers\Departament;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departament;
use Illuminate\Support\Facades\Auth;

class DepartamentController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $departament = Departament::where('status', true)->get();
        } else {
            $departament = Departament::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('departament/index')
            ->with('departament', $departament);
    }

    public static function createUpdateDepartament($datos, $company, $sede)
    {
        $departament = Departament::where('company_id', $company->id)->where('sede_id', $sede->id)->where('code_intel', $datos['departament_id']);
        if ($departament->count() > 0) {
            $departament = Departament::where('company_id', $company->id)->where('sede_id', $sede->id)->where('code_intel', $datos['departament_id'])->first();
            $departament->sede_id = $sede->id;
            $departament->name = $datos['departament_name'];
            $departament->code_intel = $datos['departament_id'];
            $departament->status = true;
            $departament->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'sede_id' => $sede->id,
                'date_created' => date('Y-m-d'),
                'name' => $datos['departament_name'],
                'code_intel' => $datos['departament_id'],
                'status' => true,
            ];
            $departament = Departament::create($data);
        }
        return $departament;
    }
    public static function createUpdateDepartamentGenera($datos, $company, $sede)
    {
        $departamentGenera = Departament::where('company_id', $company->id)->where('sede_id', $sede->id)->where('code_intel', $datos['generation_area_id']);
        if ($departamentGenera->count() > 0) {
            $departamentGenera = Departament::where('company_id', $company->id)->where('sede_id', $sede->id)->where('code_intel', $datos['generation_area_id'])->first();
            $departamentGenera->sede_id = $sede->id;
            $departamentGenera->date_created = date('Y-m-d');
            $departamentGenera->name = $datos['generation_area_name'];
            $departamentGenera->code_intel = $datos['generation_area_id'];
            $departamentGenera->status = true;
            $departamentGenera->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'sede_id' => $sede->id,
                'date_created' => date('Y-m-d'),
                'name' => $datos['generation_area_name'],
                'code_intel' => $datos['generation_area_id'],
                'status' => true,
            ];
            $departamentGenera = Departament::create($data);
        }
        return $departamentGenera;
    }
}
