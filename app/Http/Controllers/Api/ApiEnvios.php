<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\EnviosDetail;
use App\Models\EnviosHeader;
use App\Models\Region;
use Illuminate\Http\Request;
use Response;

class ApiEnvios extends Controller
{
    public function showEnviosHeader(Request $request)
    {
        try {
            $header = EnviosHeader::where('status', true)
                ->where('tipo', $request->input('tipo'))
                ->where('code_intel', $request->input('empresa'))
                ->where('date_created', $request->input('fecha'))
                ->get();
            foreach ($header as $key => $value) {
                $cantidadEnviados = EnviosDetail::where('status', true)
                    ->where('envios_header_id', $value->id)
                    ->where('estado_envio', "ENVIADO")
                    ->count();
                $totalEnvios = $value->cantidad_destinos;
                $value->procentaje = ($cantidadEnviados * 100) / $totalEnvios;
            }

            $data = [
                'code' => 200,
                'msg' => "Consulta exitosa",
                'data' => $header,
            ];
            return $data;
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

    public function showEnviosDetail(Request $request)
    {
        try {
            $detail = EnviosDetail::where('status', true)
                ->where('envios_header_id', $request->input('header'))
                ->get();

            $detail->load('customer');

            $data = [
                'code' => 200,
                'msg' => "Consulta exitosa",
                'data' => $detail,
            ];
            return $data;
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

    public function guardarEnvios(Request $request)
    {
        try {
            $parametrosJson = json_encode($request->all());
            $parametrosObject = json_decode($parametrosJson);
            $codeIntel = $parametrosObject->empresa;
            $tipo = $parametrosObject->tipo;
            $forma = $parametrosObject->forma;
            $fecha = $parametrosObject->fecha;
            $hora = $parametrosObject->hora;
            $detalle = json_decode($parametrosObject->detalle);
            $company = Company::where('code_intel', $codeIntel)->where('status', true)->first();
            $header = new EnviosHeader();
            $header->company_id = $company->id;
            $header->code_intel = $codeIntel;
            $header->date_created = date('Y-m-d');
            $header->description = "ENVIO MASIVO NUEVO";
            $header->tipo = $tipo;
            $header->cantidad_destinos = 0;
            if ($forma == 'INMEDIATO') {
                $header->envio_ahora = true;
                $header->estado_envio = "PENDIENTE";
                $header->envio_inmediato = true;
                $header->envio_programado = false;
            } else {
                $header->envio_ahora = false;
                $header->estado_envio = "PENDIENTE";
                $header->envio_inmediato = false;
                $header->envio_programado = true;
                $header->date_programado = $fecha;
                $header->time_programado = $hora;
            }
            $header->status = true;
            $header->save();
            foreach ($detalle as $key => $value) {
                $existeCliente = Customer::where('company_id', $company->id)->where('celular_1', $value[1])->where('status', true);
                if ($existeCliente->count()) {
                    $customer = Customer::where('company_id', $company->id)->where('celular_1', $value[1])->where('status', true)->first();
                } else {
                    $customer = new Customer();
                    $customer->company_id = 1;
                    $customer->name = $value[0];
                    $customer->celular_1 = $value[1];
                    $customer->save();
                }
                $detail = new EnviosDetail();
                $detail->date_created = date('Y-m-d');
                $detail->company_id = $company->id;
                $detail->customer_id = $customer->id;
                $detail->envios_header_id = $header->id;
                $detail->phone = $value[1];
                $detail->mensaje = $value[2];
                if ($forma == 'INMEDIATO') {
                    $detail->estado_envio = "PENDIENTE";
                } else {
                    $detail->estado_envio = "PROGRAMADO";
                }

                $detail->status = true;
                $detail->save();
            }
            $detallesTotales = EnviosDetail::where('envios_header_id', $header->id)->count();
            $headerFinal = EnviosHeader::find($header->id);
            $headerFinal->cantidad_destinos = $detallesTotales;
            $headerFinal->save();
            $data = [
                'code' => 200,
                'msg' => "Registro exitoso..",
            ];
            return $data;
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

    public function refreshStatus(Request $request)
    {
        try {
            $company = Company::where('code_intel', $request->input('empresa'))->where('status', true)->first();
            if ($company->whatsapp_conexion) {
                $estado = 1;
                $company->whatsapp_conexion = 0;
                $company->save();
            } else {
                $estado = 0;
            }
            $data = [
                'code' => 200,
                'estado' => $estado,
                'msg' => "Registro exitoso..",
            ];
            return $data;
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

    public function enviosInmediatos(Request $request)
    {
        $data = [];
        $company = Company::where('whatsapp_conexion', false)
            ->where('status', true)
            ->get();
        if (count($company)) {
            foreach ($company as $key => $value) {
                $companyActive = Company::find($value->id);
                $companyActive->whatsapp_conexion = true;
                $companyActive->save();
            }
        }
        $company = Company::where('code_intel', $request->input('empresa'))->where('status', true)->first();
        $existe = EnviosHeader::where('company_id', $company->id)
            ->where('envio_ahora', true)
            ->where('status', true);

        if ($existe->count()) {
            $headerPrimera = EnviosHeader::where('company_id', $company->id)
                ->where('envio_ahora', true)
                ->where('status', true)
                ->orderBy('id', 'ASC')
                ->first();
            $existeDetalles = EnviosDetail::where('company_id', $company->id)
                ->where('envios_header_id', $headerPrimera->id)
                ->whereIn('estado_envio', ["PROGRAMADO", "PENDIENTE"])
                ->where('status', true);
            if ($existeDetalles->count()) {
                $detalles = EnviosDetail::where('company_id', $company->id)
                    ->where('envios_header_id', $headerPrimera->id)
                    ->whereIn('estado_envio', ["PROGRAMADO", "PENDIENTE"])
                    ->where('status', true)
                    ->get();

                foreach ($detalles as $key => $value) {

                    $detalleIndividual = EnviosDetail::find($value->id);
                    $detalleIndividual->estado_envio = "ENVIADO";
                    $detalleIndividual->date_enviado = date('Y-m-d');
                    $detalleIndividual->time_enviado = date('H:i:s');
                    $detalleIndividual->save();

                    $celular = "+593" . substr($value->phone, 1, 9);
                    $data[] = [
                        'celular' => $celular,
                        'mensaje' => $value->mensaje,
                    ];
                }

                $headerFin = EnviosHeader::find($headerPrimera->id);
                $headerFin->envio_ahora = false;
                $headerFin->estado_envio = "ENVIADO";
                $headerFin->save();


                $data = [
                    'code' => 200,
                    'msg' => "Consulta exitosa",
                    'data' => $data,
                ];
            } else {
                $data = [
                    'code' => 202,
                    'msg' => "Consulta exitosa sin datos a enviar",
                    'data' => false,
                ];
            }
        } else {
            $data = [
                'code' => 300,
                'msg' => "No existe nada a enviar",
                'data' => false,
            ];
        }
        return $data;
    }
}
