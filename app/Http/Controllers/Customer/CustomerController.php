<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Base\BaseController;
use Response;
use PDF;

class CustomerController extends Controller
{

    public function index()
    {
        if (Auth::user()->company->principal) {
            $clientes = Customer::where('status', true)->get();
        } else {
            $clientes = Customer::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('customer/index')
            ->with('clientes', $clientes);
    }

    public function create()
    {
        return view('customer/create');
    }

    public function store(Request $request)
    {
        $tabla = 'customer';
        $data = [
            "nombres" => strtoupper($request->input('nombres')),
            "apellidos" => strtoupper($request->input('apellidos')),
            "documento" => $request->input('documento'),
            "numero_documento" => $request->input('numero_documento'),
            "direccion" => strtoupper($request->input('direccion')),
            "latitud" => $request->input('latitud'),
            "longitud" => $request->input('longitud'),
            "telefono" => $request->input('telefono'),
            "correo" => $request->input('correo'),
            "company_id" => Auth::user()->company_id,
        ];
        $cliente = Customer::create($data);
        return redirect('customer')->with('mesaje', 'Pedido creado con exito');
    }

    public function show($id)
    {
        $cliente = Customer::find($id);
        return view('customer/show')
            ->with('cliente', $cliente);
    }

    public function edit(Customer $customer)
    {
        return view('customer/edit')
            ->with('customer', $customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update(request()->all());
        return redirect('customer')
            ->with('mensaje', 'Cliente Actualizado con Éxito');
    }

    public function destroy(Customer $customer)
    {
        $customer->status = 0;
        $customer->save();
        return redirect('customer')
            ->with('mensaje', 'Cliente Eliminado Satisfactoriamente...');
    }

    public static function saveCustomerApi($request, $empresa)
    {
        $customer = Customer::where('company_id', $empresa->id)
            ->where('numero_documento', $request->input('ruc'))
            ->where('status', true);
        if ($customer->count() > 0) {
            $paciente =  Customer::where('company_id', $empresa->id)->where('numero_documento', $request->input('ruc'))->where('status', true)->first();
            $paciente->name = strtoupper($request->input('name'));
            $paciente->celular_1 = $request->input('phone');
            $paciente->correo = $request->input('email');
            $paciente->status = true;
            $paciente->save();
        } else {
            $pac = [
                'company_id' => $empresa->id,
                'numero_documento' => $request->input('ruc'),
                'name' => strtoupper($request->input('name')),
                'celular_1' => $request->input('phone'),
                'correo' => $request->input('email'),
                'status' => true,
            ];
            $paciente = Customer::create($pac);
        }
        return $paciente;
    }

    public static function createUpdateCustomer($datos, $company)
    {
        $customer = Customer::where('company_id', $company->id)->where('numero_documento', $datos['numero_documento']);
        if ($customer->count() == 0) {
            $data = [
                'company_id' => $company->id,
                'name' => $datos['nombres'] . ' ' . $datos['apellidos'],
                'nombres' => $datos['nombres'],
                'apellidos' => $datos['apellidos'],
                'type_document' => $datos['type_document'],
                'numero_documento' => $datos['numero_documento'],
                'direccion' => $datos['direccion'],
                'latitud' => $datos['latitud'],
                'longitud' => $datos['longitud'],
                'telefono' => $datos['telefono'],
                'celular_1' => $datos['celular_1'],
                'celular_2' => $datos['celular_2'],
                'celular_3' => $datos['celular_3'],
                'correo' => $datos['correo'],
                'birth_date' => $datos['birth_date'],
                'nationality' => $datos['nationality'],
                'sex' => $datos['sex']
            ];
            $customer = Customer::create($data);
        } else {
            $customer = $customer->first();
            $customer->name = $datos['nombres'] . ' ' . $datos['apellidos'];
            $customer->nombres = $datos['nombres'];
            $customer->apellidos = $datos['apellidos'];
            $customer->type_document = $datos['type_document'];
            $customer->numero_documento = $datos['numero_documento'];
            $customer->direccion = $datos['direccion'];
            $customer->latitud = $datos['latitud'];
            $customer->longitud = $datos['longitud'];
            $customer->telefono = $datos['telefono'];
            $customer->celular_1 = $datos['celular_1'];
            $customer->celular_2 = $datos['celular_2'];
            $customer->celular_3 = $datos['celular_3'];
            $customer->correo = $datos['correo'];
            $customer->birth_date = $datos['birth_date'];
            $customer->nationality = $datos['nationality'];
            $customer->sex = $datos['sex'];
            $customer->save();
        }
        return $customer;
    }

    public static function createUpdateCustomerAddress($datos, $company, $customer, $respCountry, $respCity)
    {
        $directions = CustomerAddress::where('company_id', $company->id)->where('customer_id', $customer->id);
        if ($directions->count() > 0) {
            $address = CustomerAddress::where('company_id', $company->id)->where('customer_id', $customer->id)->first();
            $address->text = $datos['direccion'];
            $address->country_id = $respCountry;
            // $address->region_id = $request->input('');
            $address->city_id = $respCity;
            $address->latitud = $datos['latitud'];
            $address->longitud = $datos['longitud'];
            $address->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'customer_id' => $customer->id,
                'text' => $datos['direccion'],
                'country_id' => $respCountry,
                // 'region_id' => $request->input(''),
                'city_id' => $respCity,
                'latitud' => $datos['latitud'],
                'longitud' => $datos['longitud']
            ];
            $address = CustomerAddress::create($data);
        }
        //Determinar direccion principal en el customer
        if ($datos['principal_direction']) {
            if ($datos['direccion'] !== null) {
                $customer = Customer::find($customer->id);
                $customer->customer_address_id = $address->id;
                $customer->save();
            }
        }
        return $address;
    }
}
