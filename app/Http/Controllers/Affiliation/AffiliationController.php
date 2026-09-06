<?php

namespace App\Http\Controllers\Affiliation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affiliation;
use Illuminate\Support\Facades\Auth;

class AffiliationController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $affiliations = Affiliation::where('status', true)->get();
        } else {
            $affiliations = Affiliation::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('affiliation/index')
            ->with('affiliations', $affiliations);
    }

    public static function createUpdateAffiliation($datos, $company, $type)
    {
        $affiliation = Affiliation::where('company_id', $company->id)->where('code_intel', $datos['company_id']);
        if ($affiliation->count() > 0) {
            $affiliation = Affiliation::where('company_id', $company->id)->where('code_intel', $datos['company_id'])->first();
            $affiliation->type_affiliation_id = $type->id;
            $affiliation->date_created = date('Y-m-d');
            $affiliation->name = $datos['affiliation_name'];
            $affiliation->percentage = $datos['porcentaje'];
            $affiliation->percentage_coverage = $datos['porcentaje_cobertura'];
            $affiliation->code_intel = $datos['company_id'];
            $affiliation->status = true;
            $affiliation->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'type_affiliation_id' => $type->id,
                'date_created' => date('Y-m-d'),
                'name' => $datos['affiliation_name'],
                'percentage' => $datos['porcentaje'],
                'percentage_coverage' => $datos['porcentaje_cobertura'],
                'code_intel' => $datos['company_id'],
                'status' => true,
            ];
            $affiliation = Affiliation::create($data);
        }
        return $affiliation;
    }
}
