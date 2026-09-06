<?php

namespace App\Http\Controllers\Whatsapp;

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

class WhatsappController extends Controller {

    public function index() {
        $services = Service::where('status', true)->get();
        $sends = SendHeader::where('date_created', date('Y-m-d'))
                ->orderBy('id', 'DESC')
                ->get();
        return view('envios/index')
                        ->with('services', $services)
                        ->with('sends', $sends);
    }

    public static function newWhatsapp($receptor, $cuerpo) {
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
        $options = stream_context_create(['http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        $result = file_get_contents($url, false, $options);
//        print_r($result);
        return true;
    }

    public static function newWhatsappFile($receptor, $link, $archivo) {
        $empresa = Company::where('principal', true)->first();
        $instance = $empresa->instancia;
        $token = $empresa->token_chatapi;
        $celular = "593" . substr($receptor, 1, 9);
        $data = [
            'phone' => $celular,
            'body' => $cuerpo,
            'filename' => $archivo,
        ];
        $json = json_encode($data);
        $url = 'https://api.chat-api.com/instance' . $instance . '/message?token=' . $token;
        $options = stream_context_create(['http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        $result = file_get_contents($url, false, $options);
//        print_r($result);
        return true;
    }

    public function traficoApis() {
        $mensajes = SendHeader::select('id')
                ->where('date_created', date('Y-m-d'))
                ->orderBy('date_created', 'DESC')
                ->get();
        $services = Service::where('status', true)->get();
        foreach ($services as $serv) {
            $serv->cantidad = SendDetail::where('service_id', $serv->id)->where('status', 'ENVIADO')->count();
        }
        $data = [
            'mensajes' => $mensajes,
            'services' => $services
        ];
        return Response::json($data);
    }

    public function newApis($id) {
        $new = SendHeader::find($id);
        $new->company_name = Company::find($new->company_id)->company_name;
        $services = Service::where('status', true)->get();
        $data = [
            'new' => $new,
            'services' => $services
        ];
        return Response::json($data);
    }

    public function showApis($id, $service) {
        $detalle = SendDetail::where('send_header_id', $id)
                ->where('service_id', $service)
                ->get();
        $detalle->load('service');
        return Response::json($detalle);
    }

}
