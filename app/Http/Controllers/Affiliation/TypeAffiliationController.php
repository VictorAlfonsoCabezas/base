<?php

namespace App\Http\Controllers\Affiliation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeAffiliation;
use Illuminate\Support\Facades\Auth;

class TypeAffiliationController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $types = TypeAffiliation::where('status', true)->get();
        } else {
            $types = TypeAffiliation::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('typeaffiliation/index')
            ->with('types', $types);
    }

    public static function createUpdateTypeAffiliation($datos, $company)
    {
        $type = TypeAffiliation::where('company_id', $company->id)->where('code_intel', $datos['company_id']);
        if ($type->count() > 0) {
            $type = TypeAffiliation::where('company_id', $company->id)->where('code_intel', $datos['company_id'])->first();
            $type->name = $datos['tipo_afiliacion_nombre'];
            $type->publico = $datos['tipo_afiliacion_publico'];
            $type->code_intel = $datos['company_id'];
            $type->status = true;
            $type->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'date_created' => date('Y-m-d'),
                'name' => $datos['tipo_afiliacion_nombre'],
                'publico' => $datos['tipo_afiliacion_publico'],
                'code_intel' => $datos['company_id'],
                'status' => true,
            ];
            $type = TypeAffiliation::create($data);
        }
        return $type;
    }
}
