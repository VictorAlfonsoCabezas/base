<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\CompanyService;
use App\Http\Controllers\Base\BaseController;
use App\Models\Sede;
use App\Models\TwilioCredenciales;
use App\User;
use Redirect;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CompanyController extends Controller
{

    public function index()
    {
        $company = Company::all();
        return view('company/index')
            ->with('company', $company);
    }

    public function create()
    {
        $token = BaseController::GenerarTokenInterno(40);
        $services = Service::where('status', true)->get();
        return view('company/create')
            ->with('token', $token)
            ->with('services', $services);
    }

    public function store(Request $request)
    {
        Company::create($request->all());
        return redirect('company')->with('mensaje', 'Empresa creada con exito');
    }

    public function update(Request $request, $id)
    {
        Company::findOrFail($id)->update($request->all());
        return redirect("company")->with('mensaje', 'Empresa Editada');
    }

    public function edit(Company $company)
    {
        $data = array();
        $services = Service::where('status', true)->get();
        foreach ($services as $serv) {
            $existe = CompanyService::where('company_id', $company->id)->where('service_id', $serv->id)->where('status', true);
            if ($existe->count() > 0) {
                $data[] = [
                    'id' => $serv->id,
                    'name' => $serv->name,
                    'vista' => true,
                ];
            } else {
                $data[] = [
                    'id' => $serv->id,
                    'name' => $serv->name,
                    'vista' => false,
                ];
            }
        }
        return view('company/edit')
            ->with('company', $company)
            ->with('service', $data);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->status = false;
        $company->save();
        return redirect('company')
            ->with('mensaje', 'Compania Eliminada Satisfactoriamente...');
    }

    public static function createUpdateCompany($datos)
    {
        $company = Company::where('code_intel', $datos['company_id']);
        if ($company->count() > 0) {
            $company = $company->first();
        } else {
            $color = substr(md5(time()), 0, 6);
            $hexadecimal_color = '#' . $color;
            $data = [
                'code_intel' => $datos['company_id'],
                'ruc' => $datos['ruc'],
                'company_name' => $datos['company_name'],
                'company_color' => $hexadecimal_color,
                'comercial_name' => $datos['company_name'],
                'address' => $datos['company_address'],
                'phone' => $datos['company_phone'],
                'email' => $datos['company_email'],
            ];
            $company = Company::create($data);
        }
        return $company;
    }

    public function showCompanies()
    {
        $sede = Sede::where('status', true)->get();
        $sede->load('company');
        return Response::json($sede);
    }

    public function conexionCompanies()
    {
        $company = Company::select('id', 'conexion')
            ->where('status', true)
            ->where('principal', false)
            ->get();
        return Response::json($company);
    }

    public function desactivarCompany($id)
    {
        $company = Company::find($id);
        $company->status = ($company->status == true) ? false : true;;
        $company->save();
        return Response::json($company);
    }

    public function knowInstance($empresa)
    {
        $company = Company::find($empresa);
        $companyPrincipal = Company::where('principal', true)->where('status', true)->first();
        $credencialesPrincipal = TwilioCredenciales::where('company_id', $companyPrincipal->id)->where('status', true)->first();
        $sedes = Sede::where('company_id', $company->id)->get();

        if($company->twilio_principal){
            foreach ($sedes as $key => $value) {
                $value->twilio_sid = $credencialesPrincipal->sid;
                $value->twilio_token = $credencialesPrincipal->token;
                $value->twilio_phone_number = $credencialesPrincipal->phone_number;
            }
        }else{
            foreach ($sedes as $key => $value) {
                $credencialesSede = TwilioCredenciales::where('company_id', $company->id)->where('sede_id', $value->id)->where('status', true)->first();
                $value->twilio_sid = isset($credencialesSede->sid) ? $credencialesSede->sid : '';
                $value->twilio_token = isset($credencialesSede->token) ? $credencialesSede->token : '';
                $value->twilio_phone_number = isset($credencialesSede->phone_number) ? $credencialesSede->phone_number : '';
            }
        }
        $data = [
            'company' => $company,
            'sedes' => $sedes
        ];
        return Response::json($data);
    }

    public function updateSede(Request $request, $id)
    {
        $sede = Sede::find($id);
        $sede->latitud = $request->input('latitud');
        $sede->longitud = $request->input('longitud');
        // $sede->instancia = $request->input('instancia');
        // $sede->token = $request->input('token');
        $sede->save();

        $existeCredenciales = TwilioCredenciales::where('company_id', $sede->company_id)->where('sede_id', $sede->id)->where('status', true);
        if($existeCredenciales->count() > 0){
            $credenciales =  TwilioCredenciales::where('company_id', $sede->company_id)->where('sede_id', $sede->id)->where('status', true)->first();
        }else{
            $credenciales =  New TwilioCredenciales();
        }
        $credenciales->company_id = $sede->company_id;
        $credenciales->sede_id = $sede->id;
        $credenciales->date_created = date('Y-m-d');
        $credenciales->phone_number = $request->input('number');
        $credenciales->sid = $request->input('instancia');
        $credenciales->token = $request->input('token');
        $credenciales->status = true;
        $credenciales->save();
        return Response::json(true);
    }
}
