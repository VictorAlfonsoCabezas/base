<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Whatsapp\WhatsappController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Email\EmailController;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Service;
use App\Models\CompanyService;
use App\Models\SendHeader;
use App\Models\SendDetail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApiWhatsappController extends Controller
{

    public function sendWhatsapp(Request $request, $instance, $token)
    {
        $company = Company::where('instancia_interno', $instance)
            ->where('token_interno', $token)
            ->where('status', true);
        if ($company->count() > 0) {
            $empresa = $company->first();
            $paciente = CustomerController::saveCustomerApi($request, $empresa);
            $header = [
                'company_id' => $empresa->id,
                'customer_id' => $paciente->id,
                'customer_name' => $paciente->name,
                'customer_phone' => $paciente->celular_1,
                'customer_email' => $paciente->correo,
                'text' => $request->input('text'),
                'date_created' => date('Y-m-d'),
                'hour_created' => date('H:i:s'),
                'observation' => 'ORDEN DESDE',
                'status' => 'COMPLETO'
            ];
            $cabecera = SendHeader::create($header);
            $data = [
                'company_id' => $empresa->id,
                'send_header_id' => $cabecera->id,
                'service_id' => 1,
                'customer_id' => $paciente->id,
                'customer_name' => $paciente->name,
                'customer_phone' => $paciente->celular_1,
                'customer_email' => $paciente->correo,
                'text' => $request->input('text'),
                'date_created' => $request->input('date_created'),
                'hour_created' => $request->input('hour_created'),
                'date_send' => $request->input('date_created'),
                'hour_send' => $request->input('hour_created'),
                'immediately' => true,
                'observation' => 'ENVIADO DESDE ORDENES',
                'status' => 'ENVIADO'
            ];
            $detalle = SendDetail::create($data);
            $detail = SendDetail::find($detalle->id);
            if (!file_exists(config('constants.RUTAS_PUBLICAS.PATH_FILE'))) {
                mkdir(config('constants.RUTAS_PUBLICAS.PATH_FILE'), 0777, true);
            }
            if (!file_exists(config('constants.RUTAS_PUBLICAS.PATH_FILE_ORDER'))) {
                mkdir(config('constants.RUTAS_PUBLICAS.PATH_FILE_ORDER'), 0777, true);
            }
            if ($request->input('file_complete') !== null) {
                $nombre = time();
                $extention = '.pdf';
                $base64_pdf = $request->input('file_complete');
                $base64_decode = base64_decode($base64_pdf);
                file_put_contents('public_image/ordenes/' . $nombre . $extention, $base64_decode);
                $detail->file = true;
                $detail->file_path = 'public_image/ordenes';
                $detail->file_name = $nombre;
                $detail->file_extension = $extention;
                $detail->save();
            }
            $respuesta = ApiWhatsappController::sendMedia($detail, $paciente);
            return json_encode(array(
                'status' => 200,
                'response' => array(
                    'msg' => 'Se envió exitosamente el whatsapp...'
                )
            ));
        } else {
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => 'La empresa no tiene instancias para enviar mensajes...'
                )
            ));
        }
    }

    public function sendWhatsapp2(Request $request)
    {
        if (!file_exists(config('constants.RUTAS_PUBLICAS.PATH_FILE'))) {
            mkdir(config('constants.RUTAS_PUBLICAS.PATH_FILE'), 0777, true);
        }

        if (!file_exists(config('constants.RUTAS_PUBLICAS.PATH_FILE_ORDER'))) {
            mkdir(config('constants.RUTAS_PUBLICAS.PATH_FILE_ORDER'), 0777, true);
        }

        if ($request->input('file_complete') !== null) {
            $nombre = time();
            $extention = '.pdf';
            $base64_pdf = $request->input('file_complete');
            $base64_decode = base64_decode($base64_pdf);
            file_put_contents('public_image/ordenes/' . $nombre . $extention, $base64_decode);
            $file_path = 'public_image/ordenes';
            $file_name = $nombre;
            $file_extension = $extention;
            $path = 'https://sig.code-v.pro/' . $file_path . '/' . $file_name . $file_extension;
        }else{
            $path = '';
        }

        return json_encode(array(
            'status' => 200,
            'path' => $path,
            'response' => array(
                'msg' => 'Se envió exitosamente el whatsapp...'
            )
        ));
    }

    public static function sendMedia($detalle, $paciente)
    {
        $path = 'https://sig.code-v.pro/' . $detalle->file_path . '/' . $detalle->file_name . $detalle->file_extension;
        $nombreArchivo = "OrdenExamen.pdf";
        $respuestaWhatsapp = ApiWhatsappController::newWhatsapp($paciente->celular_1, $detalle->text);
        $respuestaWhatsappFile = ApiWhatsappController::newWhatsappFile($paciente->celular_1, $path, $nombreArchivo);
        $estado = SendDetail::find($detalle->id);
        $estado->status = 'ENVIADO';
        $estado->save();
        return $respuestaWhatsappFile;
    }

    public static function newWhatsapp($receptor, $cuerpo)
    {
        $empresa = Company::where('principal', true)->first();
        $instance = $empresa->instancia;
        $token = $empresa->token_chatapi;
        $celular = "593" . substr($receptor, 1, 9);
        $data = [
            'phone' => $celular,
            'body' => $cuerpo,
        ];
        $json = json_encode($data);
        $url = 'https://api.chat-api.com/instance' . $instance . '/message?token=' . $token;
        $options = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        $result = file_get_contents($url, false, $options);
        //        print_r($result);
        return true;
    }

    public static function newWhatsappFile($receptor, $link, $archivo)
    {
        $empresa = Company::where('principal', true)->first();
        $instance = $empresa->instancia;
        $token = $empresa->token_chatapi;
        $celular = "593" . substr($receptor, 1, 9);
        $data = [
            "body" => $link,
            "caption" => "PRUEBAS DE ENVIOS DESDE LARAVEL",
            "filename" => $archivo,
            "phone" => $celular
        ];
        $json = json_encode($data);
        $url = 'https://api.chat-api.com/instance' . $instance . '/sendFile?token=' . $token;
        $options = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        $result = file_get_contents($url, false, $options);
        return $json;
    }
}
