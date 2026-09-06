<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
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
        return view('company/create')
            ->with('token', $token);
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
        return view('company/edit')
            ->with('company', $company);
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


}
