<?php

namespace App\Http\Controllers\Atention;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AtentionHeader;
use App\Models\AtentionDetail;
use App\Models\AtentionMedicine;
use Illuminate\Support\Facades\Auth;
use Response;

class AtentionController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $atention = AtentionHeader::where('status', true)->get();
        } else {
            $atention = AtentionHeader::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('atention/index')
            ->with('atention', $atention);
    }

    public static function createUpdateAtencion($datos, $company, $customer, $sede, $departament, $departamentGenera, $medico)
    {
        $atention = AtentionHeader::where('company_id', $company->id)->where('code_intel', $datos['code_intel']);
        if ($atention->count() > 0) {
            $atention = AtentionHeader::where('company_id', $company->id)->where('code_intel', $datos['code_intel'])->first();
            $atention->customer_id = $customer->id;
            $atention->sede_id = $sede->id;
            $atention->departament_id = $departament->id;
            $atention->doctor_id = ($medico !== false) ? $medico->id : null;
            $atention->date_created = date('Y-m-d');
            $atention->date_opening = $datos['date_opening'];
            $atention->date_atention = $datos['date_atention'];
            $atention->date_atention_end = $datos['date_atention_end'];
            $atention->oda = $datos['oda'];
            $atention->generation_area_id = $departamentGenera->id;
            $atention->generation_area_name = $departamentGenera->name;
            $atention->generation_area_externa = $datos['generation_area_externa'];
            $atention->observation = $datos['observation'];
            $atention->status_atention = $datos['status_atention'];
            $atention->status_pay = $datos['status_pay'];
            $atention->code_intel = $datos['code_intel'];
            $atention->status = true;
            $atention->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'customer_id' => $customer->id,
                'sede_id' => $sede->id,
                'departament_id' => $departament->id,
                'doctor_id' => ($medico !== false) ? $medico->id : null,
                'date_created' => date('Y-m-d'),
                'date_opening' => $datos['date_opening'],
                'date_atention' => $datos['date_atention'],
                'date_atention_end' => $datos['date_atention_end'],
                'oda' => $datos['oda'],
                'generation_area_id' => $departamentGenera->id,
                'generation_area_name' => $departamentGenera->name,
                'observation' => $datos['observation'],
                'status_atention' => $datos['status_atention'],
                'status_pay' => $datos['status_pay'],
                'code_intel' => $datos['code_intel'],
                'status' => true,
            ];
            $atention = AtentionHeader::create($data);
        }
        return $atention;
    }

    public function showProcedures($id)
    {
        $detalle = AtentionDetail::where('atention_header_id', $id)->get();
        $recetas = AtentionMedicine::where('atention_header_id', $id)->get();
        $data = [
            'detalle' => $detalle,
            'recetas' => $recetas
        ];
        return Response::json($data);
    }
}
