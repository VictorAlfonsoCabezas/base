<?php

namespace App\Http\Controllers\Sede;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;

class SedeController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $sede = Sede::all();
        } else {
            $sede = Sede::where('company_id', Auth::user()->company_id)->get();
        }
        return view('sede/index')
            ->with('sede', $sede);
    }

    public static function createUpdateSede($datos, $company)
    {
        $sede = Sede::where('company_id', $company->id)->where('code_intel', $datos['sede_id']);
        if ($sede->count() > 0) {
            $sede = Sede::where('company_id', $company->id)->where('code_intel', $datos['sede_id'])->first();
            $sede->date_created = date('Y-m-d');
            $sede->name = $datos['sede_name'];
            $sede->code_intel = $datos['sede_id'];
            $sede->status = true;
            $sede->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'date_created' => date('Y-m-d'),
                'name' => $datos['sede_name'],
                'code_intel' => $datos['sede_id'],
                'status' => true,
            ];
            $sede = Sede::create($data);
        }
        return $sede;
    }
}
