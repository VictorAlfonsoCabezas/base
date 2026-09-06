<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Affiliation\TypeAffiliationController;
use App\Http\Controllers\Affiliation\AffiliationController;
use App\Http\Controllers\Sede\SedeController;
use App\Http\Controllers\Departament\DepartamentController;
use App\Http\Controllers\Atention\AtentionController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Models\AtentionDetail;
use App\Models\AtentionHeader;
use App\Models\AtentionMedicine;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Country;
use App\Models\City;
use App\Models\Departament;
use App\Models\Procedures;
use App\Models\Region;
use App\Models\DoctorSchedule;
use App\Models\Medicine;
use App\Http\Controllers\Especialidad\EspecialidadController;
use Response;

class ApiCustomer extends Controller
{
    public function saveCustomerCrm(Request $request)
    {
        try {
            if ($request->input('country_code') !== null) {
                $country = Country::where('code', $request->input('country_code'));
                if ($country->count() == 0) {
                    $dataCountry = [
                        'name' => $request->input('nationality'),
                        'code' => $request->input('country_code'),
                    ];
                    $country = Country::create($dataCountry);
                    $respCountry = $country->id;
                } else {
                    $country = $country->first();
                    $country->name = $request->input('nationality');
                    $country->save();
                    $respCountry = $country->id;
                }
            } else {
                $respCountry = '';
            }
            if ($request->input('ciudad_code') !== null) {
                $city = City::where('code', $request->input('ciudad_code'));
                if ($city->count() == 0) {
                    $dataCity = [
                        'name' => $request->input('ciudad'),
                        'code' => $request->input('ciudad_code'),
                        'country_id' => $respCountry,
                    ];
                    $city = City::create($dataCity);
                    $respCity = $city->id;
                } else {
                    $city = $city->first();
                    $city->name = $request->input('ciudad');
                    $city->country_id = $respCountry;
                    $city->save();
                    $respCity = $city->id;
                }
            } else {
                $respCity = '';
            }
            $company = Company::where('code_intel', $request->input('company_id'));
            if ($company->count() > 0) {
                $company = $company->first();
            } else {
                $color = substr(md5(time()), 0, 6);
                $hexadecimal_color = '#' . $color;
                $data = [
                    'code_intel' => $request->input('company_id'),
                    'ruc' => $request->input('ruc'),
                    'company_name' => $request->input('company_name'),
                    'company_color' => $hexadecimal_color,
                    'comercial_name' => $request->input('company_name'),
                    'address' => $request->input('company_address'),
                    'phone' => $request->input('company_phone'),
                    'email' => $request->input('company_email'),
                ];
                $company = Company::create($data);
            }
            $customer = Customer::where('company_id', $company->id)->where('numero_documento', $request->input('numero_documento'));
            if ($customer->count() == 0) {
                $data = [
                    'company_id' => $company->id,
                    'name' => $request->input('nombres') . ' ' . $request->input('apellidos'),
                    'nombres' => $request->input('nombres'),
                    'apellidos' => $request->input('apellidos'),
                    'type_document' => $request->input('type_document'),
                    'numero_documento' => $request->input('numero_documento'),
                    'direccion' => $request->input('direccion'),
                    'latitud' => $request->input('latitud'),
                    'longitud' => $request->input('longitud'),
                    'telefono' => $request->input('telefono'),
                    'celular_1' => $request->input('celular_1'),
                    'celular_2' => $request->input('celular_2'),
                    'celular_3' => $request->input('celular_3'),
                    'correo' => $request->input('correo'),
                    'birth_date' => $request->input('birth_date'),
                    'nationality' => $request->input('nationality'),
                    'sex' => $request->input('sex')
                ];
                $customer = Customer::create($data);
            } else {
                $customer = $customer->first();
                $customer->name = $request->input('nombres') . ' ' . $request->input('apellidos');
                $customer->nombres = $request->input('nombres');
                $customer->apellidos = $request->input('apellidos');
                $customer->type_document = $request->input('type_document');
                $customer->numero_documento = $request->input('numero_documento');
                $customer->direccion = $request->input('direccion');
                $customer->latitud = $request->input('latitud');
                $customer->longitud = $request->input('longitud');
                $customer->telefono = $request->input('telefono');
                $customer->celular_1 = $request->input('celular_1');
                $customer->celular_2 = $request->input('celular_2');
                $customer->celular_3 = $request->input('celular_3');
                $customer->correo = $request->input('correo');
                $customer->birth_date = $request->input('birth_date');
                $customer->nationality = $request->input('nationality');
                $customer->sex = $request->input('sex');
                $customer->save();
            }
            if ($request->input('principal_direction')) {
                $directions = CustomerAddress::where('company_id', $company->id)->where('customer_id', $customer->id);
                if ($directions->count() > 0) {
                    $address = CustomerAddress::where('company_id', $company->id)->where('customer_id', $customer->id)->first();
                    $address->text = $request->input('direccion');
                    $address->country_id = $respCountry;
                    // $address->region_id = $request->input('');
                    $address->city_id = $respCity;
                    $address->latitud = $request->input('latitud');
                    $address->longitud = $request->input('longitud');
                    $address->save();
                } else {
                    $data = [
                        'company_id' => $company->id,
                        'customer_id' => $customer->id,
                        'text' => $request->input('direccion'),
                        'country_id' => $respCountry,
                        // 'region_id' => $request->input(''),
                        'city_id' => $respCity,
                        'latitud' => $request->input('latitud'),
                        'longitud' => $request->input('longitud')
                    ];
                    $address = CustomerAddress::create($data);
                }
                //Determinar direccion principal en el customer
                if ($request->input('principal_direction')) {
                    if ($request->input('direccion') !== null) {
                        $customerUpdate = Customer::find($customer->id);
                        $customerUpdate->customer_address_id = $address->id;
                        $customerUpdate->save();
                    }
                }
            } else {
                //agregar nueva direccion..
            }
            return json_encode(array(
                'status' => 200,
                'response' => array(
                    'msg' => 'Save or Update correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    public function saveAtentionCrm(Request $request)
    {
        try {
            $company = CompanyController::createUpdateCompany($request->all());
            if ($request->input('country_code') !== null) {
                $respCountry = CountryController::createUpdateCountry($request->all());
            } else {
                $respCountry = '';
            }
            if ($request->input('ciudad_code') !== null) {
                $respCity = CityController::createUpdateCity($request->all(), $respCountry);
            } else {
                $respCity = '';
            }
            $customer = CustomerController::createUpdateCustomer($request->all(), $company);
            if ($request->input('principal_direction')) {
                if ($request->input('direccion') !== null) {
                    $customerAddress = CustomerController::createUpdateCustomerAddress($request->all(), $company, $customer, $respCountry, $respCity);
                }
            } else {
                //agregar nueva direccion..
            }
            if ($request->input('medico_id') !== null) {
                $medico = DoctorController::createUpdateDoctor($request->all(), $company);
            } else {
                $medico = false;
            }
            $typeAffiliation = TypeAffiliationController::createUpdateTypeAffiliation($request->all(), $company);
            $affiliation = AffiliationController::createUpdateAffiliation($request->all(), $company, $typeAffiliation);
            $sede = SedeController::createUpdateSede($request->all(), $company);
            $departament = DepartamentController::createUpdateDepartament($request->all(), $company, $sede);
            $departamentGenera = DepartamentController::createUpdateDepartamentGenera($request->all(), $company, $sede);
            AtentionController::createUpdateAtencion($request->all(), $company, $customer, $sede, $departament, $departamentGenera, $medico);
            return json_encode(array(
                'status' => 200,
                'response' => array(
                    'msg' => 'Save or Update correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    public function saveAtentionDetailCrm(Request $request)
    {
        try {
            $company = Company::where('code_intel', $request->input('company_id'))->first();
            $header = AtentionHeader::where('company_id', $company->id)->where('code_intel', $request->input('code_intel_header'))->first();
            AtentionDetail::where('company_id', $company->id)->where('atention_header_id', $header->id)->delete();
            foreach ($request->input('detalle') as $key => $detail) {
                $procedure = Procedures::where('company_id', $company->id)->where('code_intel', $detail['procedure_id']);
                if ($procedure->count() > 0) {
                    $procedure = $procedure->first();
                    $procedure->name = $detail['procedure_name'];
                    $procedure->code_intel_type = $detail['type_procedure_id'];
                    $procedure->type_name = $detail['type_procedure_name'];
                    $procedure->save();
                } else {
                    $data = [
                        'company_id' => $company->id,
                        'date_created' => date('Y-m-d'),
                        'code_intel' => $detail['procedure_id'],
                        'name' => $detail['procedure_name'],
                        'code_intel_type' => $detail['type_procedure_id'],
                        'type_name' => $detail['type_procedure_name'],
                        'status' => true
                    ];
                    $procedure = Procedures::create($data);
                }
                $dataDetail = [
                    'company_id' => $company->id,
                    'atention_header_id' => $header->id,
                    'procedures_id' => $procedure->id,
                    'procedures_name' => $procedure->name,
                    'status' => true,
                ];
                $existe = AtentionDetail::where('company_id', $company->id)->where('atention_header_id', $header->id)->where('procedures_id', $procedure->id);
                if ($existe->count() == 0) {
                    AtentionDetail::create($dataDetail);
                }
            }
            return json_encode(array(
                'status' => 200,
                'response' => array(
                    'msg' => 'Save or Update Detail correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    public function saveDoctorScheduleCrm(Request $request)
    {
        dd($request->all());
        // try {
        $company = CompanyController::createUpdateCompany($request->all());
        $medico = DoctorController::createUpdateDoctor($request->all(), $company);
        $sede = SedeController::createUpdateSede($request->all(), $company);
        $departament = DepartamentController::createUpdateDepartament($request->all(), $company, $sede);
        //Borra Id que no estén para poder actualizar los existentes
        DoctorSchedule::where('company_id', $company->id)->where('doctor_id', $medico->id)->whereNotIn('code_intel', $request->input('some_code_inter'))->delete();
        foreach ($request->input('detalle') as $key => $detail) {
            $schedule = DoctorSchedule::where('company_id', $company->id)->where('code_intel', $detail['code_intel']);
            if ($schedule->count() > 0) {
                $schedule = DoctorSchedule::where('company_id', $company->id)->where('code_intel', $detail['code_intel'])->first();
                $schedule->company_id = $company->id;
                $schedule->doctor_id  = $medico->id;
                $schedule->doctor_name = $medico->name;
                $schedule->hour_start = $detail['hour_start'];
                $schedule->hour_end = $detail['hour_end'];
                $schedule->day = $detail['day'];
                $schedule->date_total = $detail['date_total'];
                $schedule->interval = $detail['interval'];
                $schedule->sede_id  = $sede->id;
                $schedule->sede_name = $sede->name;
                $schedule->departament_id  = $departament->id;
                $schedule->departament_name = $departament->name;
                $schedule->code_intel = $detail['code_intel'];
                $schedule->status = true;
                $schedule->save();
            } else {
                $data = [
                    'company_id' => $company->id,
                    'date_created' => date('Y-m-d'),
                    'doctor_id' => $medico->id,
                    'doctor_name' => $medico->name,
                    'hour_start' => $detail['hour_start'],
                    'hour_end' => $detail['hour_end'],
                    'day' => $detail['day'],
                    'date_total' => $detail['date_total'],
                    'interval' => $detail['interval'],
                    'sede_id' => $sede->id,
                    'sede_name' => $sede->name,
                    'departament_id' => $departament->id,
                    'departament_name' => $departament->name,
                    'code_intel' => $detail['code_intel'],
                    'status' => true
                ];
                $existe = DoctorSchedule::where('company_id', $company->id)->where('code_intel', $detail['code_intel']);
                if ($existe->count() == 0) {
                    $schedule = DoctorSchedule::create($data);
                }
            }
        }
        EspecialidadController::createUpdateEspecialidad($request->input('detalle'), $request->input('espe_code_inter'), $company, $medico);
        return json_encode(array(
            'status' => 200,
            'response' => array(
                'msg' => 'Save or Update Schedule correctly...'
            )
        ));
        // } catch (\Exception $exc) {
        //     $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
        //     return json_encode(array(
        //         'status' => 400,
        //         'response' => array(
        //             'msg' => $e
        //         )
        //     ));
        // }
    }

    public function saveMedicamentoCrm(Request $request)
    {
        try {
            $company = CompanyController::createUpdateCompany($request->all());
            $header = AtentionHeader::where('company_id', $company->id)->where('code_intel', $request->input('code_intel_header'))->first();
            if ($header !== null) {
                //Borra Id que no estén para poder actualizar los existentes
                AtentionMedicine::where('company_id', $company->id)->where('atention_header_id', $header->id)->whereNotIn('code_intel', $request->input('some_code_inter'))->delete();
                foreach ($request->input('detalle') as $key => $detail) {
                    $medicamento = Medicine::where('company_id', $company->id)->where('code_intel', $detail['code_intel_medicine']);
                    if ($medicamento->count() > 0) {
                        $medicamento = $medicamento->first();
                        $medicamento->name = $detail['medicine_name'];
                        $medicamento->code_intel = $detail['code_intel_medicine'];
                        $medicamento->observation = 'Actualizado desde el CRM';
                        $medicamento->status = true;
                        $medicamento->save();
                    } else {
                        $data = [
                            'company_id' => $company->id,
                            'date_created' => date('Y-m-d'),
                            'code_intel' => $detail['code_intel_medicine'],
                            'name' => $detail['medicine_name'],
                            'observation' => 'Creado desde el CRM',
                            'status' => true
                        ];
                        $medicamento = Medicine::create($data);
                    }
                    $atentionMedicine = AtentionMedicine::where('company_id', $company->id)->where('atention_header_id', $header->id)->where('medicine_id', $medicamento->id);
                    if ($atentionMedicine->count() > 0) {
                        $atentionMedicine = $atentionMedicine->first();
                        $atentionMedicine->medicine_id = $medicamento->id;
                        $atentionMedicine->medicine_name = $medicamento->name;
                        $atentionMedicine->dosis = $detail['dosis'];
                        $atentionMedicine->observation = $detail['observation'];
                        $atentionMedicine->total = $detail['total'];
                        $atentionMedicine->status_dispatched = $detail['status_despacho'];
                        // $atentionMedicine->reservado_1 = '';
                        // $atentionMedicine->reservado_2 = '';
                        $atentionMedicine->save();
                        $header->date_order =  $request->input('date_order');
                        $header->save();
                    } else {
                        $dataMedicine = [
                            'company_id' => $company->id,
                            'atention_header_id' => $header->id,
                            'medicine_id' => $medicamento->id,
                            'medicine_name' => $medicamento->name,
                            'date_created' => date('Y-m-d'),
                            'dosis' => $detail['dosis'],
                            'observation' => $detail['observation'],
                            'total' => $detail['total'],
                            'status_dispatched' => $detail['status_despacho'],
                            // 'reservado_1' => '',
                            // 'reservado_2' => '',
                            'code_intel' => $detail['code_intel'],
                            'status' => true,
                        ];
                        AtentionMedicine::create($dataMedicine);
                        $header->date_order =  $request->input('date_order');
                        $header->save();
                    }
                }
                return json_encode(array(
                    'status' => 200,
                    'response' => array(
                        'msg' => 'Save or Update Detail correctly...'
                    )
                ));
            } else {
                return json_encode(array(
                    'status' => 300,
                    'response' => array(
                        'msg' => 'No Existe esa atencion...'
                    )
                ));
            }
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }
}
