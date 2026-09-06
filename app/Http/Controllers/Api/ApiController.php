<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Whatsapp\WhatsappController;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\SendHeader;
use App\Models\SendDetail;
use App\Models\Plan;
use App\Models\PlanService;
use App\Models\Suscription;
use App\Models\Service;
use App\Models\Campania;
use App\Http\Controllers\Base\BaseController;
use Response;

class ApiController extends Controller
{

    public function showPlans(Request $request)
    {
        $instancia = $request->input('instancia');
        $token = $request->input('token');
        if ($instancia !== 0 && $token !== 0) {
            $company = Company::where('instancia_interno', $instancia)->where('token_interno', $token);
            if ($company->count() > 0) {
                $company = Company::where('instancia_interno', $instancia)->where('token_interno', $token)->first();
                $planes = Plan::find($company->plan_id);
                $services = Service::where('status', true)->get();
                foreach ($services as $serv) {
                    $existe = PlanService::where('plan_id', $planes->id)->where('service_id', $serv->id)->where('status', true);
                    if ($existe->count() > 0) {
                        $cantidad = PlanService::where('plan_id', $planes->id)->where('service_id', $serv->id)->where('status', true)->first()->cantidad;
                        $serv->cantidad = $cantidad;
                        $serv->vista = true;
                    } else {
                        $serv->cantidad = 0;
                        $serv->vista = false;
                    }
                }
                $data = [
                    'code' => 200,
                    'msg' => 'Cliente ya tiene un Plan',
                    'planes' => $planes,
                    'services' => $services
                ];
                return Response::json($data);
            } else {
                $planes = Plan::where('status', true)->get();
                foreach ($planes as $plan) {
                    $services = Service::where('status', true)->get();
                    foreach ($services as $serv) {
                        $existe = PlanService::where('plan_id', $plan->id)->where('service_id', $serv->id)->where('status', true);
                        if ($existe->count() > 0) {
                            $cantidad = PlanService::where('plan_id', $plan->id)->where('service_id', $serv->id)->where('status', true)->first()->cantidad;
                            $serv->cantidad = $cantidad;
                            $serv->vista = true;
                        } else {
                            $serv->cantidad = 0;
                            $serv->vista = false;
                        }
                    }
                    $plan->services = $services;
                }
                $data = [
                    'code' => 250,
                    'msg' => 'Cliente Nuevo o Plan Expirado',
                    'planes' => $planes
                ];
                return Response::json($data);
            }
        } else {
            $planes = Plan::where('status', true)->get();
            foreach ($planes as $plan) {
                $services = Service::where('status', true)->get();
                foreach ($services as $serv) {
                    $existe = PlanService::where('plan_id', $plan->id)->where('service_id', $serv->id)->where('status', true);
                    if ($existe->count() > 0) {
                        $cantidad = PlanService::where('plan_id', $plan->id)->where('service_id', $serv->id)->where('status', true)->first()->cantidad;
                        $serv->cantidad = $cantidad;
                        $serv->vista = true;
                    } else {
                        $serv->cantidad = 0;
                        $serv->vista = false;
                    }
                }
                $plan->services = $services;
            }
            $data = [
                'code' => 300,
                'msg' => 'Cliente Nuevo',
                'planes' => $planes
            ];
            return Response::json($data);
        }
    }

    public function openPlan(Request $request)
    {
        $instancia = BaseController::GenerarInstancia(6);
        $token = BaseController::GenerarTokenInterno(40);
        $color = substr(md5(time()), 0, 6);
        $hexadecimal_color = '#' . $color;
        $data = [
            "code_intel" => $request->input('company_intel'),
            "company_name" => strtoupper($request->input('company_name')),
            "company_color" => $hexadecimal_color,
            "comercial_name" => strtoupper($request->input('company_name')),
            "ruc" => $request->input('ruc'),
            "address" => strtoupper($request->input('direction')),
            "email" => $request->input('email'),
            "instancia_interno" => $instancia,
            "token_interno" => $token,
            "plan_id" => $request->input('plan_id'),
            "plan_status" => 'ACTIVO',
        ];
        $company = Company::where('code_intel', $request->input('company_intel'));
        if ($company->count() == 0) {
            $company = Company::create($data);
            $suscription = ApiController::crearSuscription($company, $request->input('plan_id'));
            $respuesta = [
                'code' => 200,
                'msg' => 'Creación Exitosamente',
                'instancia' => $instancia,
                'token' => $token,
                'suscription' => $suscription,
            ];
            return Response::json($respuesta);
        } else {
            $company = Company::where('code_intel', $request->input('company_intel'))->first();
            $suscription = ApiController::crearSuscription($company, $request->input('plan_id'));
            $respuesta = [
                'code' => 300,
                'msg' => 'Empresa ya existente',
                'instancia' => $company->instancia_interno,
                'token' => $company->token_interno,
                'suscription' => $suscription

            ];
            return Response::json($respuesta);
        }
    }

    public static function crearSuscription($company, $plan_id)
    {
        $plan = Plan::find($plan_id);
        $dateActual = date('Y-m-d');
        $dateFin = date("Y-m-d", strtotime($dateActual . "+ 1 month"));
        $data = [
            'company_id' => $company->id,
            'plan_id' => $plan->id,
            'date_created' => $dateActual,
            'date_finish' => $dateFin,
            'renewall' => true,
            'status' => true,
        ];
        $existe = Suscription::where('company_id', $company->id)->where('date_finish', '>=', $dateActual)->where('status', true);
        if ($existe->count() == 0) {
            $suscription = Suscription::create($data);
        } else {
            $suscription = Suscription::where('company_id', $company->id)->where('date_finish', '>=', $dateActual)->where('status', true)->first();
        }
        return $suscription;
    }

    public function indexCampania(Request $request)
    {
        $instancia = $request->input('instancia');
        $token = $request->input('token');
        if ($instancia !== 0 && $token !== 0) {
            $company = Company::where('instancia_interno', $instancia)->where('token_interno', $token);
            if ($company->count() > 0) {
                $company = Company::where('instancia_interno', $instancia)->where('token_interno', $token)->first();
                $campanias = Campania::where('company_id', $company->id)->get();
                $data = [
                    'code' => 200,
                    'msg' => 'Lista de campañas...',
                    'campanias' => $campanias
                ];
                return Response::json($data);
            } else {
                $data = [
                    'code' => 300,
                    'msg' => 'Token no existente...'
                ];
                return Response::json($data);
            }
        } else {
            $data = [
                'code' => 400,
                'msg' => 'Cliente sin plan...'
            ];
            return Response::json($data);
        }
    }

    public function sendInformationIntel(Request $request, $instance, $token)
    {
        $company = Company::where('instancia_interno', $instance)
            ->where('token_interno', $token)
            ->where('status', true);
        if ($company->count() > 0) {
            $empresa = $company->first();
            $paciente = CustomerController::saveCustomerApi($request, $empresa);
            if ($request->input('immediately')) {
                $caso = 1;
            } elseif ($request->input('programmed') && $request->input('reminder') == false && $request->input('recurrence') == false && $request->input('immediately') == false) {
                $caso = 2;
            } elseif ($request->input('programmed') && $request->input('reminder') && $request->input('recurrence') == false) {
                $caso = 3;
            } elseif ($request->input('programmed') && $request->input('reminder') == false && $request->input('recurrence')) {
                $caso = 4;
            }
            // switch ($caso) {
            //Inmediato
            // case 1:
            //     $header = [
            //         'company_id' => $empresa->id,
            //         'campania' => $request->input('campania'),
            //         'customer_id' => $paciente->id,
            //         'customer_name' => $paciente->name,
            //         'customer_phone' => $paciente->telefono,
            //         'customer_email' => $paciente->correo,
            //         'text' => $request->input('text'),
            //         'date_created' => date('Y-m-d'),
            //         'hour_created' => date('H:i:s'),
            //         'observation' => 'ENVIADO DESDE LA API',
            //         'status' => 'COMPLETO'
            //     ];
            //     $cabecera = SendHeader::create($header);
            //     $planService = PlanService::where('plan_id', $empresa->plan_id);
            //     foreach ($planService->get() as $plan) {
            //         $ser = Service::find($plan->service_id);
            //         $data = [
            //             'company_id' => $empresa->id,
            //             'send_header_id' => $cabecera->id,
            //             'service_id' => $plan->service_id,
            //             'service_name' => $ser->name,
            //             'campania' => $request->input('campania'),
            //             'customer_id' => $paciente->id,
            //             'customer_name' => $paciente->name,
            //             'customer_phone' => $paciente->telefono,
            //             'customer_email' => $paciente->correo,
            //             'text' => $request->input('text'),
            //             'date_created' => $request->input('date_created'),
            //             'hour_created' => $request->input('hour_created'),
            //             'date_send' => $request->input('date_created'),
            //             'hour_send' => $request->input('hour_created'),
            //             'immediately' => true,
            //             'observation' => 'ENVIADO DESDE LA API',
            //             'status' => 'ENVIADO'
            //         ];
            //         $detalle = SendDetail::create($data);
            //         ApiController::sendMedia($detalle, $paciente, $plan->service_id);
            //         }

            //         return('sale');
            //     }
            //     break;
            //     //Programado a futuro
            // case 2:
            //     $header = [
            //         'company_id' => $empresa->id,
            //         'campania' => $request->input('campania'),
            //         'customer_id' => $paciente->id,
            //         'customer_name' => $paciente->name,
            //         'customer_phone' => $paciente->telefono,
            //         'customer_email' => $paciente->correo,
            //         'text' => $request->input('text'),
            //         'date_created' => date('Y-m-d'),
            //         'hour_created' => date('H:i:s'),
            //         'observation' => 'ENVIADO DESDE LA API',
            //         'status' => 'PROGRAMADO'
            //     ];
            //     $cabecera = SendHeader::create($header);
            //     $planService = PlanService::where('plan_id', $empresa->plan_id);
            //     foreach ($planService->get() as $plan) {
            //         $ser = Service::find($plan->service_id);
            //         $data = [
            //             'company_id' => $empresa->id,
            //             'send_header_id' => $cabecera->id,
            //             'service_id' => $plan->service_id,
            //             'service_name' => $ser->name,
            //             'campania' => $request->input('campania'),
            //             'customer_id' => $paciente->id,
            //             'customer_name' => $paciente->name,
            //             'customer_phone' => $paciente->telefono,
            //             'customer_email' => $paciente->correo,
            //             'text' => $request->input('text'),
            //             'date_created' => $request->input('date_created'),
            //             'hour_created' => $request->input('hour_created'),
            //             'date_send' => $request->input('date_created'),
            //             'hour_send' => $request->input('hour_created'),
            //             'programmed' => true,
            //             'observation' => 'ENVIADO DESDE LA API',
            //             'status' => 'PROGRAMADO'
            //         ];
            //         $detalle = SendDetail::create($data);
            //     }
            //     break;
            //     //Programado con antelacion
            // case 3:
            //     $header = [
            //         'company_id' => $empresa->id,
            //         'campania' => $request->input('campania'),
            //         'customer_id' => $paciente->id,
            //         'customer_name' => $paciente->name,
            //         'customer_phone' => $paciente->telefono,
            //         'customer_email' => $paciente->correo,
            //         'text' => $request->input('text'),
            //         'date_created' => date('Y-m-d'),
            //         'hour_created' => date('H:i:s'),
            //         'observation' => 'ENVIADO DESDE LA API',
            //         'status' => 'PROGRAMADO'
            //     ];
            //     $cabecera = SendHeader::create($header);
            //     //calculamos el dia con antelacion a enviar
            //     $dia = $request->input('reminder_valor');
            //     $valor = $request->input('reminder_type');
            //     $fecha = $request->input('date_created');
            //     $date_new = date("Y-m-d", strtotime($fecha . "- $dia $valor"));

            //     $planService = PlanService::where('plan_id', $empresa->plan_id);
            //     foreach ($planService->get() as $plan) {
            //         $ser = Service::find($plan->service_id);
            //         $data = [
            //             'company_id' => $empresa->id,
            //             'send_header_id' => $cabecera->id,
            //             'service_id' => $plan->service_id,
            //             'service_name' => $ser->name,
            //             'campania' => $request->input('campania'),
            //             'customer_id' => $paciente->id,
            //             'customer_name' => $paciente->name,
            //             'customer_phone' => $paciente->telefono,
            //             'customer_email' => $paciente->correo,
            //             'text' => $request->input('text'),
            //             'date_created' => $request->input('date_created'),
            //             'hour_created' => $request->input('hour_created'),
            //             'programmed' => true,
            //             'reminder' => true,
            //             'date_send' => $date_new,
            //             'hour_send' => $request->input('hour_created'),
            //             'reminder_type' => $request->input('reminder_type'),
            //             'reminder_valor' => $request->input('reminder_valor'),
            //             'observation' => 'ENVIADO DESDE LA API',
            //             'status' => 'PROGRAMADO'
            //         ];
            //         $detalle = SendDetail::create($data);
            //     }
            //     break;
            //     //Programado recurrente
            // case 4:
            // $header = [
            //     'company_id' => $empresa->id,
            //     'campania' => $request->input('campania'),
            //     'customer_id' => $paciente->id,
            //     'customer_name' => $paciente->name,
            //     'customer_phone' => $paciente->telefono,
            //     'customer_email' => $paciente->correo,
            //     'text' => $request->input('text'),
            //     'date_created' => date('Y-m-d'),
            //     'hour_created' => date('H:i:s'),
            //     'observation' => 'ENVIADO DESDE LA API',
            //     'status' => 'PROGRAMADO'
            // ];
            // $cabecera = SendHeader::create($header);
            // $services = CompanyService::where('company_id', $empresa->id);
            // foreach ($services->get() as $ser) {
            //     $i = 1;
            //     while ($i <= $request->input('lapsos')) {
            //         if ($i == 1) {
            //             $date_new = $request->input('date_created');
            //         } else {
            //             //calculamos el dia con antelacion a enviar
            //             $valor = $request->input('recurrence_valor');
            //             $tipo = $request->input('recurrence_type');
            //             $fecha = $date_new;
            //             $date_new = date("Y-m-d", strtotime($fecha . "+ $valor $tipo"));
            //         }
            //         $data = [
            //             'company_id' => $empresa->id,
            //             'send_header_id' => $cabecera->id,
            //             'service_id' => $ser->service_id,
            //             'service_name' => $ser->name,
            //             'campania' => $request->input('campania'),
            //             'customer_id' => $paciente->id,
            //             'customer_name' => $paciente->name,
            //             'customer_phone' => $paciente->telefono,
            //             'customer_email' => $paciente->correo,
            //             'text' => $request->input('text'),
            //             'date_created' => $request->input('date_created'),
            //             'hour_created' => $request->input('hour_created'),
            //             'programmed' => true,
            //             'recurrence' => true,
            //             'date_send' => $date_new,
            //             'hour_send' => $request->input('hour_created'),
            //             'recurrence_type' => $request->input('recurrence_type'),
            //             'recurrence_valor' => $request->input('recurrence_valor'),
            //             'lapsos' => $request->input('lapsos'),
            //             'observation' => 'ENVIADO DESDE LA API',
            //             'status' => 'PROGRAMADO'
            //         ];
            //         $detalle = SendDetail::create($data);
            //         $i++;
            //     }
            // }
            // break;
            // }
            return json_encode(array(
                'status' => 200,
                'response' => array(
                    'msg' => 'Se envio la informacion con éxito...'
                )
            ));
        } else {
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => 'No existe informacion para esos datos ...'
                )
            ));
        }
    }

    public static function sendMedia($detalle, $paciente, $service)
    {
        switch ($service) {
                //Whatsapp
            case 1:
                $respuestaWhatsapp = WhatsappController::newWhatsapp($paciente->telefono, $detalle->text);
                $estado = SendDetail::find($detalle->id);
                $estado->status = 'ENVIADO';
                $estado->save();
                break;
                //SMS
            case 2:
                $estado = SendDetail::find($detalle->id);
                $estado->status = 'CANCELADO';
                $estado->save();
                break;
                //Correos
            case 3:
                $respuestaCorreo = EmailController::newEmail($paciente->correo, $detalle->text);
                $estado = SendDetail::find($detalle->id);
                $estado->status = 'ENVIADO';
                $estado->save();
                break;
        }
    }
}
