<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kushki\KushkiController;
use Illuminate\Http\Request;
use App\Models\ApiHeader;
use App\Models\Region;
use App\Models\BotHeader;
use App\Models\BotDetail;
use App\Models\BotHistorial;
use App\Models\BotCustomerResponse;
use App\Models\ChatBotHeader;
use App\Models\ChatBotDetail;
use App\Models\Company;
use App\Models\Customer;
use App\Models\ApiDetail;
use App\Models\ApiParameters;
use App\Http\Controllers\MiPrimerCrud\MiPrimerCrudController;
use App\Models\CustomerAddress;
use App\Models\Sede;
use App\Models\TwilioCredenciales;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\File;

class WebhooksTwilioController extends Controller
{
    public static function webhookstwilio(Request $request)
    {

        $MESSAGE = ($request->input('Body') !== null) ? $request->input('Body') : 'Comparte ubicación';
        $receptorJohn = $request->input('WaId');
        $nombreWhatsapp = $request->input('ProfileName');
        $latitudRecive = $request->input('Latitude');
        $longitudRecive = $request->input('Longitude');
        $twilioIdentificador = $request->input('SmsMessageSid');
        $numeroQueEnvia = $request->input('To');
        $customer = WebhooksTwilioController::buscarCliente($receptorJohn, $nombreWhatsapp);
        $company = WebhooksTwilioController::buscarEmpresa($customer);
        $header = WebhooksTwilioController::buscarBotRespuesta($company, $customer, $MESSAGE);
        $chatHeader = WebhooksTwilioController::buscarChatCabecera($company, $header, $customer, $twilioIdentificador, $numeroQueEnvia);


        if ($chatHeader->agente) {
            $data = [
                'company_id' => $company,
                'date_created' => date('Y-m-d'),
                'chat_bot_header_id' =>  $chatHeader->id,
                'customer_answer' => $MESSAGE,
                'description' => 'Primer Mensaje Paciente',
                'first_message' => false,
                'last_message' => false,
                'bot' => false,
                'date_format' => date('Y-m-d H:i:s'),
                'status' => true,
            ];
            ChatBotDetail::create($data);
        } else {
            WebhooksTwilioController::guardarDatosConsultas($company, $customer, $chatHeader);
            $data = WebhooksTwilioController::mensajesRecibidos($company, $chatHeader, $header, $customer, $MESSAGE, $latitudRecive, $longitudRecive);
            $first = $data['respuesta'];
            $ultimoMensaje = $data['ultimoMensaje'];
            $cerrarElChat = $data['cerrarElChat'];
            $apiHeader = $data['apiHeader'];



            if (!$ultimoMensaje and !$cerrarElChat) {
                $mensajesInmediatos = true;
                while ($mensajesInmediatos) {
                    $detailNew = [];
                    $detailNew = WebhooksTwilioController::proximoMensajeAccion($header->id, $company, $MESSAGE, $customer->id, $first, $apiHeader);
                    if ($detailNew['detalle']) {
                        $detalleNew = BotDetail::find($detailNew['detalle']);
                        $headerNew = BotHeader::find($detalleNew->bot_header_id);
                        if (!$detailNew['respuesta']) {
                            WebhooksTwilioController::closeBotIsLast($chatHeader->id, $detalleNew->last_message, $customer->id);
                        }

                        if ($detalleNew->close_chat) {
                            WebhooksTwilioController::closeBotLast($chatHeader->id, $customer->id);
                            WebhooksTwilioController::sedeMasCercana($chatHeader->id, $customer->id);
                        }

                        if ($detalleNew->agent_start) {
                            WebhooksTwilioController::dirigirAgente($chatHeader->id);
                        }

                        $mensaje = $detailNew['mensaje'];
                        if ($detalleNew->home) {
                            $mensaje .= "\n\n" . $headerNew->home_texto;
                        }
                        if ($detalleNew->back) {
                            $mensaje .= "\n\n" . $headerNew->back_texto;
                        }


                        WebhooksTwilioController::newWhatsapp($receptorJohn, $mensaje, $detalleNew->id, $company, $detailNew['media']);


                        $data = [
                            'company_id' => $company,
                            'date_created' => date('Y-m-d'),
                            'chat_bot_header_id' =>  $chatHeader->id,
                            'bot_detail_id' => $detalleNew->id,
                            'bot_question' => $mensaje,
                            // 'customer_answer' => $MESSAGE,
                            'description' => 'Interaccion desde el Cliente con el BOT',
                            'last_message' => true,
                            'bot' => true,
                            'date_format' => date('Y-m-d H:i:s'),
                            // 'messagenumber' => 0,
                            'status' => $detailNew['mensajeError'],
                        ];
                        ChatBotDetail::create($data);
                    } else {
                        $mensaje = $detailNew['mensaje'];
                        WebhooksTwilioController::newWhatsapp($receptorJohn, $mensaje, null, $company, $detailNew['media']);
                        $data = [
                            'company_id' => $company,
                            'date_created' => date('Y-m-d'),
                            'chat_bot_header_id' =>  $chatHeader->id,
                            'bot_question' => $mensaje,
                            // 'customer_answer' => $MESSAGE,
                            'description' => 'Interaccion desde el Cliente con el BOT',
                            'last_message' => true,
                            'bot' => true,
                            'date_format' => date('Y-m-d H:i:s'),
                            'messagenumber' => 0,
                            'status' => $detailNew['mensajeError'],
                        ];
                        ChatBotDetail::create($data);
                    }
                    $historial = BotHistorial::where('bot_header_id', $detalleNew->bot_header_id)->where('bot_detail_id', $detailNew['detalle'])->where('status', true);
                    if ($historial->count() !== 0) {
                        $historial = BotHistorial::where('bot_header_id', $detalleNew->bot_header_id)->where('bot_detail_id', $detailNew['detalle'])->where('status', true)->first();
                        $inmediato =  BotDetail::where('id', $historial->main_answer_id)->where('send_inmediately', true);
                        if ($inmediato->count() > 0) {
                            $mensajesInmediatos = true;
                            $first = false;
                        } else {
                            $mensajesInmediatos = false;
                        }
                    } else {
                        $mensajesInmediatos = false;
                    }
                }
            } else {
                WebhooksTwilioController::closeBotLast($chatHeader->id, $customer->id);
                WebhooksTwilioController::sedeMasCercana($chatHeader->id, $customer->id);
            }
        }
        $data2 = [
            'data' => "ok\n",
            "status" => 200
        ];
        $result = [
            'result' => $data2
        ];
        return Response::json($result);
    }

    public static function buscarCliente($telefono, $nombre)
    {
        $customer = Customer::where('celular_1', $telefono);
        if ($customer->count() > 0) {
            $customer = $customer->first();
        } else {
            $empresaPrincipal = Company::where('principal', true)->where('status', true)->first();
            $data = [
                'company_id' => $empresaPrincipal->id,
                'name' => $nombre,
                'celular_1' => $telefono,
                'status' => true
            ];
            $customer = Customer::create($data);
        }
        return $customer;
    }

    public static function buscarEmpresa($customer)
    {
        if ($customer->company_assigned_id !== null && $customer->company_assigned_id !== '') {
            $existeChatsPrincipal = ChatBotHeader::where('company_id', $customer->company_id)->where('customer_id', $customer->id)->where('status', true);
            if ($existeChatsPrincipal->count() > 0) {
                $empresa = $customer->company_id;
            } else {
                $empresa = $customer->company_assigned_id;
            }
        } else {
            $empresa = $customer->company_id;
        }
        return $empresa;
    }

    public static function buscarBotRespuesta($company, $customer, $MESSAGE)
    {
        $campania = BotHeader::where('company_id', $company)
            ->where('status', true)
            ->where('start_code', $MESSAGE);
        if ($campania->count() > 0) {
            $header = $campania->first();
        } else {
            $bots = ChatBotHeader::where('customer_id', $customer->id)
                ->where('status', true);
            if ($bots->count() > 0) {
                $chatBotHeader = $bots->first();
                $header = BotHeader::find($chatBotHeader->bot_header_id);
            } else {

                $chatPrincipal = ChatBotHeader::where('customer_id', $customer->id)
                    // ->where('bot_header_id', 6)
                    ->where('date_created',  date('Y-m-d'))
                    ->where('status', false)
                    ->orderBy('id', 'DESC')
                    ->first();

                if (isset($chatPrincipal->bot_conection_id)) {
                    if ($chatPrincipal->bot_conection_id !== null) {
                        $existeConection = BotHeader::where('company_id', $company)
                            ->where('bot_conection_id', $chatPrincipal->bot_conection_id)
                            ->where('status', true);
                        if ($existeConection->count()) {
                            $header = BotHeader::where('company_id', $company)
                                ->where('bot_conection_id', $chatPrincipal->bot_conection_id)
                                ->where('status', true)
                                ->first();
                        } else {
                            $header = BotHeader::where('company_id', $company)
                                ->where('status', true)
                                ->first();
                        }
                    } else {
                        $header = BotHeader::where('company_id', $company)
                            ->where('status', true)
                            ->first();
                    }
                } else {
                    $header = BotHeader::where('company_id', $company)
                        ->where('status', true)
                        ->first();
                }
            }
        }
        return $header;
    }

    public static function buscarChatCabecera($company, $header, $customer, $twilioIdentificador, $numeroQueEnvia)
    {
        $chatHeader = ChatBotHeader::where('company_id', $company)
            ->where('bot_header_id', $header->id)
            ->where('status', true);
        if ($chatHeader->count() == 0) {
            $data = [
                'company_id' => $company,
                'date_created' => date('Y-m-d'),
                'bot_header_id' =>  $header->id,
                'customer_id' =>  $customer->id,
                'name' => $numeroQueEnvia,
                'description' => 'Menssage Default',
                'chatId' => $twilioIdentificador,
                'status' => true,
            ];
            $chatHeader = ChatBotHeader::create($data);
        } else {
            $chatHeader = ChatBotHeader::where('company_id', $company)
                ->where('bot_header_id', $header->id)
                ->where('status', true)
                ->first();
        }
        return $chatHeader;
    }

    public static function guardarDatosConsultas($company, $customer, $chatHeader)
    {
        $botCustomerResponse = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)->where('status', true);
        if ($botCustomerResponse->count() == 0) {
            //guardar sede al inicar
            if ($customer->sede_id !== null) {
                // if(($customer->company->principal == false) && $customer->sede_id !== null){
                $data = [
                    'chat_bot_header_id' => $chatHeader->id,
                    'date_created' => date('Y-m-d'),
                    'table_name' => 'sede',
                    'campo_name' => 'sede',
                    'response_customer' => $customer->sede_id,
                    'status' => true,
                ];
                BotCustomerResponse::create($data);
            }
            $data0 = [
                'chat_bot_header_id' => $chatHeader->id,
                'date_created' => date('Y-m-d'),
                'table_name' => 'customer',
                'campo_name' => 'ruc',
                'response_customer' => $customer->numero_documento,
                'status' => true,
            ];
            BotCustomerResponse::create($data0);
            $data1 = [
                'chat_bot_header_id' => $chatHeader->id,
                'date_created' => date('Y-m-d'),
                'table_name' => 'customer',
                'campo_name' => 'id',
                'response_customer' => $customer->id,
                'status' => true,
            ];
            BotCustomerResponse::create($data1);
            $data2 = [
                'chat_bot_header_id' => $chatHeader->id,
                'date_created' => date('Y-m-d'),
                'table_name' =>  'customer',
                'campo_name' =>  'customer_id',
                'response_customer' => $customer->id,
                'status' => true,
            ];
            BotCustomerResponse::create($data2);
            $data3 = [
                'chat_bot_header_id' => $chatHeader->id,
                'date_created' => date('Y-m-d'),
                'table_name' =>  'company',
                'campo_name' =>  'id',
                'response_customer' => $company,
                'status' => true,
            ];
            BotCustomerResponse::create($data3);
            $data4 = [
                'chat_bot_header_id' => $chatHeader->id,
                'date_created' => date('Y-m-d'),
                'table_name' =>  'company',
                'campo_name' =>  'company_id',
                'response_customer' => $company,
                'status' => true,
            ];
            BotCustomerResponse::create($data4);
            $data5 = [
                'chat_bot_header_id' => $chatHeader->id,
                'date_created' => date('Y-m-d'),
                'table_name' =>  'chat_bot_header',
                'campo_name' =>  'id',
                'response_customer' => $chatHeader->id,
                'status' => true,
            ];
            BotCustomerResponse::create($data5);
        }
    }

    public static function newWhatsapp($receptor, $cuerpo, $detalleID, $companyId, $media)
    {
        $company = Company::find($companyId);
        if ($company->twilio_principal) {
            $companyPrincipal = Company::where('principal', true)->where('status', true)->first();
            $credenciales = TwilioCredenciales::where('company_id', $companyPrincipal->id)->where('status', true)->first();
        } else {
            $credenciales = TwilioCredenciales::where('company_id', $companyId)->where('status', true)->first();
        }

        $sid    = $credenciales->sid;
        $token  = $credenciales->token;
        $number = $credenciales->phone_number;
        if (is_null($detalleID)) {
            $twilio = new Client($sid, $token);
            $message = $twilio->messages
                ->create(
                    "whatsapp:+" . $receptor, // to 
                    array(
                        "from" => "whatsapp:+" . $number,
                        "body" => $cuerpo
                    )
                );
            if ($media) {
                $twilio = new Client($sid, $token);
                $message = $twilio->messages
                    ->create(
                        "whatsapp:+" . $receptor, // to 
                        array(
                            "from" => "whatsapp:+" . $number,
                            "mediaUrl" => $media,
                        )
                    );
            }
        } else {
            $BotDetail = BotDetail::find($detalleID);
            if (is_null($BotDetail->path_file)) {
                $twilio = new Client($sid, $token);
                $message = $twilio->messages
                    ->create(
                        "whatsapp:+" . $receptor, // to 
                        array(
                            "from" => "whatsapp:+" . $number,
                            "body" => $cuerpo
                        )
                    );
            } else {
                $twilio = new Client($sid, $token);
                $message = $twilio->messages
                    ->create(
                        "whatsapp:+" . $receptor, // to 
                        array(
                            "from" => "whatsapp:+" . $number,
                            "body" => $cuerpo,
                            "mediaUrl" => "https://sigcrm.pro" . $BotDetail->path_file . $BotDetail->name_file,
                            "contentType" => "image/gif"
                        )
                    );
            }

            if ($media) {
                $twilio = new Client($sid, $token);
                $message = $twilio->messages
                    ->create(
                        "whatsapp:+" . $receptor, // to 
                        array(
                            "from" => "whatsapp:+" . $number,
                            "mediaUrl" => $media,
                        )
                    );
            }
        }
        return true;
    }

    public static function proximoMensajeAccion($headerId, $company, $mensajeWhatsapp, $customer_id, $first, $apiHeader)
    {
        $respuesta = false;
        $mensajeArray = [];
        $button = '';
        $cuerpo = '';
        $respuestaErronea = true;
        $media = 0;
        $historiales = false;
        $chatHeader = ChatBotHeader::where('company_id', $company)
            ->where('bot_header_id', $headerId)
            ->where('status', true)
            ->first();
        if ($first) {
            $botDetailPrimero = BotDetail::where('company_id', $company)
                ->where('bot_header_id', $headerId)
                ->where('order', 1)
                ->where('status', true)
                ->first();
            $historiales = BotHistorial::where('company_id', $company)
                ->where('bot_header_id', $headerId)
                ->where('bot_detail_id', $botDetailPrimero->id)
                ->where('status', true);

            $historial = $historiales->first();
            $detailSiguiente = BotDetail::find($botDetailPrimero->id);
            $detalle = $detailSiguiente->id;

            if ($botDetailPrimero->intention->code == 'APR') {
                $customerCompleto = Customer::find($customer_id);
                if (is_null($customerCompleto->nombres) or is_null($customerCompleto->apellidos) or is_null($customerCompleto->numero_documento) or is_null($customerCompleto->celular_1)) {
                    $detailSiguiente = BotDetail::find($botDetailPrimero->id);
                    $detalle = $detailSiguiente->id;
                } else {
                    $detailSiguienteBuscar = BotHistorial::where('company_id', $company)->where('bot_header_id', $headerId)->where('bot_detail_id', $botDetailPrimero->id)->where('api_header_code', 200)->first();
                    $detailSiguiente = BotDetail::find($detailSiguienteBuscar->main_answer_id);
                    $detalle = $detailSiguiente->id;
                }
            }
        } else {
            $chatDetalle = ChatBotDetail::where('company_id', $company)
                ->where('chat_bot_header_id', $chatHeader->id)
                ->where('bot', true)
                ->where('status', true)
                ->orderBy('id', 'DESC')
                ->first();

            if ($chatDetalle->botDetail->intention->code == 'OP') {
                $historiales = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $headerId)
                    ->where('bot_detail_id', $chatDetalle->bot_detail_id)
                    ->where('opcion', $mensajeWhatsapp)
                    ->where('status', true);
                if ($historiales->count() !== 0) {
                    $historiales = BotHistorial::where('company_id', $company)
                        ->where('bot_header_id', $headerId)
                        ->where('bot_detail_id', $chatDetalle->bot_detail_id)
                        ->where('opcion', $mensajeWhatsapp)
                        ->where('status', true);
                    $historial = $historiales->first();
                    $detailSiguiente = BotDetail::find($historial->main_answer_id);
                    $detalle = $detailSiguiente->id;
                } else {
                    $historiales = false;
                }
            } else if ($chatDetalle->botDetail->intention->code == 'AP') {
                if ($apiHeader !== null) {
                    $botCustomerResponse = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)->where('api_header_id', $apiHeader)->first();
                    $selection = intval($mensajeWhatsapp);
                    $existeIndice = false;
                    $i = 1;
                    foreach (json_decode($botCustomerResponse->json_response) as $value) {
                        if ($i == $selection) {
                            $existeIndice = true;
                        }
                        $i++;
                    }
                    if ($existeIndice) {
                        $historiales = BotHistorial::where('company_id', $company)
                            ->where('bot_header_id', $headerId)
                            ->where('bot_detail_id', $chatDetalle->bot_detail_id)
                            ->where('status', true);
                        $historial = $historiales->first();
                        $detailSiguiente = BotDetail::find($historial->main_answer_id);
                        $detalle = $detailSiguiente->id;
                    } else {
                        $historiales = false;
                    }
                } else {
                    $historiales = false;
                }
            } else {
                $historiales = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $headerId)
                    ->where('bot_detail_id', $chatDetalle->bot_detail_id)
                    ->where('status', true);
                $historial = $historiales->first();
                $detailSiguiente = BotDetail::find($historial->main_answer_id);
                $detalle = $detailSiguiente->id;
            }



            if ($chatDetalle->botDetail->home) {
                $botHeaderVerificarHome = BotHeader::find($chatDetalle->botDetail->bot_header_id);
                if ($botHeaderVerificarHome->home_codigo == $mensajeWhatsapp) {
                    $detailSiguiente = BotDetail::where('bot_header_id', $chatDetalle->botDetail->bot_header_id)->where('home_principal', true)->where('status', true)->first();
                    $detalle = $detailSiguiente->id;
                    $historiales = true;
                }
            }



            if ($chatDetalle->botDetail->back) {
                $ultimoSelect = $chatDetalle->botDetail->id;
                $chatDetalleAnterior = ChatBotDetail::where('company_id', $company)
                    ->where('chat_bot_header_id', $chatHeader->id)
                    ->where('bot', true)
                    ->where('status', true)
                    ->whereNotIn('bot_detail_id', [$ultimoSelect])
                    ->orderBy('id', 'DESC')
                    ->first();

                $botHeaderVerificarHome = BotHeader::find($chatDetalleAnterior->botDetail->bot_header_id);
                if ($botHeaderVerificarHome->back_codigo == $mensajeWhatsapp) {
                    $detailSiguiente = BotDetail::find($chatDetalleAnterior->botDetail->id);
                    $detalle = $detailSiguiente->id;
                    $historiales = true;
                }
            }
        }






        if ($historiales == false) {
            $opcion = 'SN';
        } else {
            if ($detailSiguiente->intention->code == 'PAKU') {
                if ($chatHeader->pay_status == "approvedTransaction") {
                    $opcion = 'PAKU';
                } else {
                    $opcion = 'SP';
                }
            } else if ($detailSiguiente->intention->code == 'IM') {
                $opcion = 'DE';
            } else {
                $opcion = $detailSiguiente->intention->code;
            }
        }




        // $region = [
        //     'name' => 'opcion: ' . $opcion
        // ];
        // Region::create($region);

        switch ($opcion) {
            case 'OP':
                $respuesta = true;
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $headerId)
                    ->where('bot_detail_id', $detailSiguiente->id)
                    ->where('status', true);

                if ($historial->count() > 0) {
                    $historial = $historial->first();
                    $detalle = $historial->bot_detail_id;
                } else {
                    $historial = false;
                    $detalle = $historial;
                }
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                $cuerpo = $detalleNew->description;
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $detalleNew->bot_header_id)
                    ->where('bot_detail_id', $detalleNew->id)
                    ->where('status', true)
                    ->orderBy('order', 'ASC');

                if ($historial->count() > 0) {
                    foreach ($historial->get() as $key => $value) {
                        $mensaje .= "\n" . '*' . $value->opcion . '*' . ' ' . $value->description;
                        $button = $value->opcion  . ' ' . $value->description;
                        array_push($mensajeArray, $button);
                    }
                }
                break;

            case 'OPV':
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $headerId)
                    ->where('bot_detail_id', $chatDetalleLast->bot_detail_id)
                    ->where('opcion', $mensajeWhatsapp)
                    ->where('status', true);

                if ($historial->count() > 0) {
                    $historial = $historial->first();
                    $detalle = $historial->main_answer_id;
                } else {
                    $historial = false;
                    $detalle = $historial;
                }


                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;

            case 'AP':
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $detalleNew->bot_header_id)
                    ->where('bot_detail_id', $detalleNew->id)
                    ->where('status', true)
                    ->first();
                if ($historial->api_header_id !== null && $historial->api_header_id !== '') {
                    $api = ApiHeader::find($historial->api_header_id);
                    $url = $api->api_link;
                    $method = $api->method;
                    //***    CRM 1 SIGCENTER 2    ****//
                    if ($api->type_api == 1) {
                        $data = [
                            'api_header_id' => $api->id,
                            'customer_id' => $customer_id,
                            'company_id' => $company,
                            'chat_bot_header_id' => $chatHeader->id,
                        ];
                        $json = json_encode($data);
                        $options = stream_context_create([
                            'http' => [
                                'method' => $method,
                                'header' => 'Content-type: application/json',
                                'content' => $json
                            ]
                        ]);
                        $result = file_get_contents($url, false, $options);
                        $respuesta = json_decode($result);
                        if ($respuesta->status == 200) {
                            $array = $respuesta->data;
                        }
                    } else {
                        if ($api->need_table) {
                            $array = [];
                            $company = Company::find($api->company_id);
                            $TABLE = $api->table_name;
                            $detail = ApiDetail::where('company_id', $api->company_id)
                                ->where('api_header_id', $api->id)
                                ->get();
                            $campos = '';
                            foreach ($detail as $key => $value) {
                                if ($key == 0) {
                                    $campos .= $value->column_name;
                                } else {
                                    $campos .= ' ,' . $value->column_name;
                                }
                            }

                            $parameters = ApiParameters::where('company_id', $api->company_id)
                                ->where('api_header_id', $api->id)
                                ->where('status', true)
                                ->get();

                            $param = '';
                            foreach ($parameters as $key => $value) {
                                $existe = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)
                                    ->where('campo_name', $value->name)
                                    ->where('status', true);

                                if ($existe->count()) {
                                    $customerResponse = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)
                                        ->where('campo_name', $value->name)
                                        ->where('status', true)
                                        ->first();

                                    if ($param == '') {
                                        $param .= $value->name . '=' . "'" . $customerResponse->response_customer . "'";
                                    } else {
                                        $param .= ' AND ' . $value->name . '=' . "'" . $customerResponse->response_customer . "'";
                                    }
                                }
                            }

                            if ($param == '') {
                                $sql = "SELECT $campos FROM $TABLE";
                            } else {
                                $sql = "SELECT $campos FROM $TABLE WHERE $param";
                            }


                            $url = $company->url . $api->api_link;
                            $data = [
                                'empresa' => $company->code_intel,
                                'SQL' => $sql
                            ];
                            $json = json_encode($data);
                            $options = stream_context_create([
                                'http' => [
                                    'method' => 'POST',
                                    'header' => 'Content-type: application/json',
                                    'content' => $json
                                ]
                            ]);
                            $result = file_get_contents($url, false, $options);
                            $respuesta = json_decode($result);
                            if ($respuesta->code == 200) {
                                $array = $respuesta->data;
                            }
                        } else {


                            $array = [];
                            $company = Company::find($api->company_id);
                            $parameters = ApiParameters::where('company_id', $api->company_id)
                                ->where('api_header_id', $api->id)
                                ->get();
                            if (count($parameters) > 0) {
                                $url = $company->url . $api->api_link;
                                $fechaAgenda = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)
                                    ->where('campo_name', 'fecha_agenda')
                                    ->where('status', true)
                                    ->first();
                                if (isset($fechaAgenda->response_customer)) {
                                    $fechaNew = strtoupper($fechaAgenda->response_customer);
                                    if ($fechaNew !== 'HOY') {
                                        $fecha = $fechaAgenda->response_customer;
                                    } else {
                                        $fecha = date('Y-m-d');
                                    }
                                } else {
                                    $fecha = date('Y-m-d');
                                }
                                $data = [
                                    'fecha' => $fecha,
                                    'empresa' => $company->code_intel
                                ];



                                foreach ($parameters as $value) {
                                    if ($value->name !== null) {





                                        $existeParametros = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)
                                            ->where('campo_name', $value->name)
                                            ->where('status', true);
                                        if ($existeParametros->count() > 0) {
                                            $parametrosCustomer = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)
                                                ->where('campo_name', $value->name)
                                                ->where('status', true)
                                                ->first();
                                            $data[$value->name] = $parametrosCustomer->response_customer;
                                        }
                                    }
                                }
                                $json = json_encode($data);
                                $options = stream_context_create([
                                    'http' => [
                                        'method' => 'POST',
                                        'header' => 'Content-type: application/json',
                                        'content' => $json
                                    ]
                                ]);
                                $result = file_get_contents($url, false, $options);
                                $respuesta = json_decode($result);

                                if ($respuesta->code == 200) {
                                    $array = $respuesta->data;
                                }

                                if ($respuesta->code == 202) {
                                    $path = 'resultados';
                                    if (!file_exists('resultados')) {
                                        File::makeDirectory(public_path() . '/' . $path, 0777, true);
                                    }
                                    $nombre = $company->id . '-' . $customer_id . '-' . $detalle;
                                    $extention = '.pdf';
                                    // // File::delete(public_path() . '/' . $nombre . $extention);

                                    $base64_decode = base64_decode($respuesta->data);
                                    file_put_contents('resultados/' . $nombre . $extention, $base64_decode);
                                    $media = 'https://sigcrm.pro/resultados/' . $nombre . $extention;
                                }
                            }
                        }
                    }


                    //**** guardar json en campo de datos ****//
                    $dataJsonBotCustomerResponse = [];
                    $dataJsonBotCustomerResponse = [
                        'chat_bot_header_id' => $chatHeader->id,
                        'api_header_id' => $api->id,
                        'date_created' => date('Y-m-d'),
                        'json_response' => json_encode($respuesta->data),
                        'status' => true,
                    ];
                    BotCustomerResponse::create($dataJsonBotCustomerResponse);
                    //**** fin guardar json en campo de datos ****//
                    $index = 1;
                    foreach ($array as $key => $value) {
                        $keyNew = 0;
                        foreach ($value as $val) {
                            if ($keyNew == 0) {
                                $mensaje .= "\n" . '*' . $index . '*';
                                $keyNew++;
                            } else {
                                $mensaje .= ' ' . $val;
                            }
                        }
                        $index++;
                    }
                }
                break;


            case 'RE':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;
            case 'FA':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;
            case 'LO':
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;

                // $historial = BotHistorial::where('company_id', $company)
                //     ->where('bot_header_id', $detalleNew->bot_header_id)
                //     ->where('bot_detail_id', $detalleNew->id)
                //     ->where('status', true)
                //     ->first();
                // if ($historial->api_header_id !== null && $historial->api_header_id !== '') {
                //     $api = ApiHeader::find($historial->api_header_id);
                //     $url = $api->api_link;
                //     $method = $api->method;
                //     //**** dividir coordenadas ****//
                //     $valor = $mensajeWhatsapp;
                //     $primera = '';
                //     for ($i = 0; $i < strlen($valor); $i++) {
                //         if ($valor[$i] == ';') {
                //             $primera = substr($valor, 0, $i);
                //             $final = $i + 1;
                //         }
                //     }
                //     $segunda = substr($valor, $final);
                //     //**** Fin dividir coordenadas ****//
                //     $data = [
                //         'api_header_id' => $api->id,
                //         'customer_id' => $customer_id,
                //         'company_id' => $company,
                //         'latitud' => $primera,
                //         'longitud' => $segunda
                //     ];
                //     $json = json_encode($data);
                //     $options = stream_context_create([
                //         'http' => [
                //             'method' => $method,
                //             'header' => 'Content-type: application/json',
                //             'content' => $json
                //         ]
                //     ]);
                //     $result = file_get_contents($url, false, $options);
                //     $resultObject = json_decode($result);

                //     //**** Cambio de Company segun localización ****//
                //     // $latitud = $primera;
                //     // $longitud = $segunda;
                //     // $menor_distance = '';
                //     // $company_selected = '';
                //     // $companies = Company::where('principal', false)
                //     //     ->where('status', true)->get();
                //     // foreach ($companies as $key => $com) {
                //     //     if ($com->latitud !== null && $com->latitud !== '' && $com->longitud !== null && $com->longitud !== '') {
                //     //         $url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' . $longitud . ',' . $latitud . ';' . $com->longitud . ',' . $com->latitud . '?overview=false&alternatives=true&steps=true&access_token=pk.eyJ1IjoiZmFyYWRheTIiLCJhIjoiTUVHbDl5OCJ9.buFaqIdaIM3iXr1BOYKpsQ';
                //     //         $options = stream_context_create([
                //     //             'http' => [
                //     //                 'method' => 'GET',
                //     //                 'header' => 'Content-type: application/json'
                //     //             ]
                //     //         ]);
                //     //         $result = file_get_contents($url, false, $options);
                //     //         $resultObject = json_decode($result);
                //     //         $distance = $resultObject->routes[0]->distance;
                //     //         if ($key == 0) {
                //     //             $menor_distance = $distance;
                //     //             $company_selected = $com->id;
                //     //         } else {
                //     //             if ($menor_distance >= $distance) {
                //     //                 $menor_distance = $distance;
                //     //                 $company_selected = $com->id;
                //     //             }
                //     //         }
                //     //     }
                //     //     $customer = Customer::find($customer_id);
                //     //     $customer->company_id = $company_selected;
                //     //     $customer->save();
                //     // }
                //     //**** FinCambio de Company segun localización ****//
                // }
                break;
            case 'LOD':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;

            case 'APR':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;
            case 'APRE':
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;

            case 'GUCAM':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;

            case 'GU':
                $respuesta = false;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;

                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $detalleNew->bot_header_id)
                    ->where('bot_detail_id', $detalleNew->id)
                    ->where('status', true)
                    ->first();

                if ($historial->api_header_id !== null && $historial->api_header_id !== '') {
                    $api = ApiHeader::find($historial->api_header_id);
                    $url = $api->api_link;
                    $method = $api->method;
                    $data = [
                        'api_header_id' => $api->id,
                        'chat_bot_header_id' => $chatHeader->id,
                        'customer_id' => $customer_id,
                        'company_id' => $company
                    ];
                    $json = json_encode($data);
                    $options = stream_context_create([
                        'http' => [
                            'method' => $method,
                            'header' => 'Content-type: application/json',
                            'content' => $json
                        ]
                    ]);
                    $result = file_get_contents($url, false, $options);
                    $resultObject = json_decode($result);
                }
                break;

            case 'SL':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                $linkInfo = KushkiController::crearSmartLink($chatHeader->id, $company, $customer_id);
                $mensaje .= "\n" . $linkInfo['link'];
                break;

            case 'PAKU':
                $respuesta = true;
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                $precio = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)->where('campo_name', 'servicio')->first();
                $linkRIDE = KushkiController::crearPacienteAtencionPrefacturaFacturaSigcenter($company, $customer_id, $precio->response_opcion, $chatHeader->id);
                //****   LINK DE RIDE COLOCAR SIMBOLOS CORRECTOS   ****//
                $linkSlash = str_replace('\\', '/', $linkRIDE['link']);
                $linkFinal = str_replace(' ', '%20', $linkSlash);
                //**** FIN LINK DE RIDE COLOCAR SIMBOLOS CORRECTOS ****//
                $mensaje .= "\n" . $linkFinal;
                break;

            case 'SN':
                $respuestaErronea = false;
                $mensaje = '😔 Lo siento no puedo entenderte';
                break;
            case 'SP':
                $respuestaErronea = false;
                $mensaje = '🫥 El Pago no esta como confirmado, por favor verifica que se haya finalizado con éxito y vuelve a ingresar el número de ticket...';
                break;
            case 'DE':
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;
        }




        $texto = $mensaje;
        $centinela = true;
        while ($centinela) {
            if (strpos($texto, '[CRM]')) {
                $inicio_1 = (strpos($texto, '[CRM]'));
                $fin_1 = 5;
                $separador_1 = substr($texto, $inicio_1, $fin_1);
                $inicio_2 = (strpos($texto, '[/CRM]'));
                $fin_2 = 6;
                $separador_2 = substr($texto, $inicio_2, $fin_2);
                $espacios_final = $inicio_2 + 6;
                $final = $espacios_final - $inicio_1;
                $tabla_campo_paramentros = substr($texto, $inicio_1, $final);
                $tabla_campo = str_replace($separador_1, '', $tabla_campo_paramentros);
                $tabla_campo_solo = str_replace($separador_2, '', $tabla_campo);
                $separar = (strpos($tabla_campo_solo, '.'));
                $tabla = substr($tabla_campo_solo, 0, $separar);
                $campo = substr($tabla_campo_solo, $separar + 1);
                $sql = "SELECT $campo FROM $tabla WHERE id = $customer_id";
                $respuestaSQL = DB::select($sql);
                $texto = str_replace($tabla_campo_paramentros, $respuestaSQL[0]->$campo, $texto);
            } else {
                $centinela = false;
            }
        }
        $mensaje = $texto;

        $data = [
            'detalle' => (isset($detalleNew->id) ? $detalleNew->id : false),
            'mensaje' => $mensaje,
            'mensajeArray' => $mensajeArray,
            'cuerpo' => $cuerpo,
            'respuesta' => $respuesta,
            'mensajeError' => $respuestaErronea,
            'media' => $media,
        ];
        return $data;
    }

    public static function actionRespuestaCliente($headerId, $company, $botDetailId, $mensajeWhatsapp, $customer, $lati, $long)
    {
        $chatHeader = ChatBotHeader::where('company_id', $company)
            ->where('bot_header_id', $headerId)
            ->where('status', true)
            ->first();

        $botDetail = BotDetail::find($botDetailId);
        switch ($botDetail->intention->code) {
            case 'OP':
                //Comprobar si tiene una conexion
                $existe = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $botDetail->bot_header_id)
                    ->where('bot_detail_id', $botDetail->id)
                    ->where('opcion', $mensajeWhatsapp)
                    ->where('status', true);

                if ($existe->count()) {
                    $botHistorial = BotHistorial::where('company_id', $company)
                        ->where('bot_header_id', $botDetail->bot_header_id)
                        ->where('bot_detail_id', $botDetail->id)
                        ->where('opcion', $mensajeWhatsapp)
                        ->where('status', true)
                        ->first();
                    if ($botHistorial->bot_conection_id !== null) {
                        $chatHeader->bot_conection_id = $botHistorial->bot_conection_id;
                        $chatHeader->save();
                    }
                }
                break;

            case 'OPV':

                break;

            case 'AP':
                break;


            case 'RE':
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $botDetail->bot_header_id)
                    ->where('bot_detail_id', $botDetail->id)
                    ->where('status', true)
                    ->first();

                if ($historial->api_header_id !== null && $historial->api_header_id !== '') {
                    $api = ApiHeader::find($historial->api_header_id);
                    $url = $api->api_link;
                    $method = $api->method;
                    $data = [
                        'api_header_id' => $api->id,
                        'chat_bot_header_id' => $chatHeader->id,
                        'bot_detail_id' => $botDetail->id,
                        'dato_actualizar' => $mensajeWhatsapp,
                    ];

                    $json = json_encode($data);
                    $options = stream_context_create([
                        'http' => [
                            'method' => $method,
                            'header' => 'Content-type: application/json',
                            'content' => $json
                        ]
                    ]);
                    $result = file_get_contents($url, false, $options);
                    $resultObject = json_decode($result);
                }
                break;

            case 'LO':
                $repuesta = true;
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $botDetail->bot_header_id)
                    ->where('bot_detail_id', $botDetail->id)
                    ->where('status', true)
                    ->first();

                if ($historial->api_header_id !== null && $historial->api_header_id !== '') {
                    $api = ApiHeader::find($historial->api_header_id);
                    $url = $api->api_link;
                    $method = $api->method;

                    $data = [
                        'api_header_id' => $api->id,
                        'chat_bot_header_id' => $chatHeader->id,
                        'latitud' => $lati,
                        'longitud' => $long
                    ];
                    $json = json_encode($data);
                    $options = stream_context_create([
                        'http' => [
                            'method' => $method,
                            'header' => 'Content-type: application/json',
                            'content' => $json
                        ]
                    ]);
                    $result = file_get_contents($url, false, $options);
                    $resultObject = json_decode($result);
                }
                break;
            case 'LOD':
                $repuesta = true;
                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $botDetail->bot_header_id)
                    ->where('bot_detail_id', $botDetail->id)
                    ->where('status', true)
                    ->first();
                if ($historial->api_header_id !== null && $historial->api_header_id !== '') {
                    $api = ApiHeader::find($historial->api_header_id);
                    $url = $api->api_link;
                    $method = $api->method;
                    $data = [
                        'api_header_id' => $api->id,
                        'parametro' => $customer->id,
                        'resultado' => $mensajeWhatsapp
                    ];
                    $json = json_encode($data);
                    $options = stream_context_create([
                        'http' => [
                            'method' => $method,
                            'header' => 'Content-type: application/json',
                            'content' => $json
                        ]
                    ]);
                    $result = file_get_contents($url, false, $options);
                    $resultObject = json_decode($result);
                }
                break;

            case 'APR':
                $repuesta = true;
                if ($customer->numero_documento == null) {
                    $ruc = $mensajeWhatsapp;
                    $date = date('d-m-Y');
                    if (strlen($ruc) == 10) {
                        //Esto para la api del msp antigua
                        if (false) {
                            $date = date('d-m-Y');
                            $url = 'https://coresalud.msp.gob.ec/coresalud/app.php/publico/rpis/afiliacion/consultafiliacion/' . $ruc . '/' . $date;
                            $options = stream_context_create([
                                'http' => [
                                    'method' => 'POST',
                                    'header' => 'Content-type: application/json',
                                    'timeout' => 5
                                ]
                            ]);
                            $result = file_get_contents($url, false, $options);
                            if ($result !== false) {


                                preg_match_all("(<span class=\"label label-success\">(.*)</span>)", $result, $matches1);
                                if (isset($matches1[1][0])) {
                                    $nombre = $matches1[1][0];
                                    if ($nombre != '') {
                                        $nombreArray = explode(" ", $nombre);
                                        $apellidos  =  implode(" ", array_slice($nombreArray, 0, 2));
                                        $nombres =  implode(" ", array_slice($nombreArray, 2, 2)); // Desde PHP 5.3.0
                                        $pacienteNombre['APELLIDOS'] = $apellidos;
                                        $pacienteNombre['NOMBRE'] = $nombres;
                                        //Buscamos la fecha de nacimiento que esta dentro de estos <span>
                                        preg_match_all("(<span class=\"label label-success\">Fecha Nacimiento: (.*)</span>)", $result, $matches1);
                                        if (isset($matches1[1][0])) {
                                            $fecha = $matches1[1][0];
                                            $fechaTemp = explode("/", $fecha);
                                            $fechaNac = $fechaTemp[2] . "-" . $fechaTemp[1] . "-" . $fechaTemp[0];
                                            $pacienteNombre['FECHA_NAC'] = $fechaNac;
                                        }
                                    }
                                }
                            }
                        }
                        $tipo = 6;
                        $data = MiPrimerCrudController::consultaDatosCliente($ruc, $tipo);
                        if ($data['code'] == 200) {
                            $NOMBRES =  $data['data']["NOMBRE"];
                            $APELLIDOS =  $data['data']["APELLIDOS"];
                            $SEXO =  $data['data']["sexo"];
                            $FECHA_NACIMIENTO =  $data['data']["FECHA_NAC"];
                        }
                    } else {
                        //en este caso es otro tipo de identificacion
                    }
                    if (isset($NOMBRES) && isset($APELLIDOS)) {
                        $fin_espacio = (strpos($NOMBRES, ' '));
                        $soloName = substr($NOMBRES, 0, $fin_espacio);
                        $customer = Customer::find($customer->id);
                        $customer->name = $soloName;
                        $customer->nombres = $NOMBRES;
                        $customer->apellidos = $APELLIDOS;
                        $customer->sex = $SEXO;
                        $customer->numero_documento = $mensajeWhatsapp;
                        $customer->birth_date = $FECHA_NACIMIENTO;
                        $customer->save();
                        $code = '200';
                    } else {
                        $customer = Customer::find($customer->id);
                        $customer->numero_documento = $ruc;
                        $customer->save();
                        $code = '400';
                    }
                    $historial = BotHistorial::where('company_id', $company)
                        ->where('bot_header_id', $headerId)
                        ->where('bot_detail_id', $botDetail->id)
                        ->where('api_header_code', $code)
                        ->where('status', true);
                } else {
                    $code = '200';
                    $historial = BotHistorial::where('company_id', $company)
                        ->where('bot_header_id', $headerId)
                        ->where('bot_detail_id', $botDetail->id)
                        ->where('api_header_code', $code)
                        ->where('status', true);
                }
                break;
            case 'APRE':

                break;

            case 'GUCAM':

                break;

            case 'GU':

                break;

            case 'FA':
                $dataFechaAgenda = [
                    'chat_bot_header_id' => $chatHeader->id,
                    'date_created' => date('Y-m-d'),
                    'campo_name' => 'fecha_agenda',
                    'index_response' => strtoupper($mensajeWhatsapp),
                    'response_customer' => strtoupper($mensajeWhatsapp),
                    'status' => true,
                ];
                BotCustomerResponse::create($dataFechaAgenda);
                break;
            case 'SL':

                break;

            case 'SN':

                break;

            case 'DE':

                break;
        }
    }

    public static function mensajesRecibidos($company, $chatHeader, $header, $customer, $MESSAGE, $latitudRecive, $longitudRecive)
    {
        $ultimoMensaje =  false;
        $cerrarElChat = false;
        $apiHeader = null;
        $isFirstDetail = ChatBotDetail::where('company_id', $company)->where('chat_bot_header_id', $chatHeader->id)->where('first_message', true)->where('status', true);
        if ($isFirstDetail->count() == 0) {
            $respuesta = true;
            $data = [
                'company_id' => $company,
                'date_created' => date('Y-m-d'),
                'chat_bot_header_id' =>  $chatHeader->id,
                'customer_answer' => $MESSAGE,
                'description' => 'Primer Mensaje Paciente',
                'first_message' => $respuesta,
                'last_message' => false,
                'bot' => false,
                'date_format' => date('Y-m-d H:i:s'),
                'status' => true,
            ];
            ChatBotDetail::create($data);
        } else {
            $respuesta = false;
            $determinar = ChatBotDetail::where('company_id', $company)
                ->where('chat_bot_header_id', $chatHeader->id)
                ->where('bot', true)
                ->where('status', true)
                ->orderBy('id', 'DESC')
                ->first();
            $BotDetail = BotDetail::find($determinar->bot_detail_id);
            if ($BotDetail->intention->code == 'AP') {
                $BotHistorial = BotHistorial::where('bot_detail_id', $BotDetail->id)
                    ->where('company_id', $company)
                    ->where('status', true)
                    ->first();

                $apiHeader = (isset($BotHistorial)) ? $BotHistorial->api_header_id : null;
                if (isset($BotHistorial)) {
                    $apiHeader = $BotHistorial->api_header_id;
                    //****** GUARDAR BOT CUSTOMER INFORMATION ******//
                    WebhooksTwilioController::guardarCamposConAlias($apiHeader, $chatHeader->id, $MESSAGE);
                    //**** FIN GUARDAR BOT CUSTOMER INFORMATION ****//
                } else {
                    $apiHeader = null;
                }
            }
            $ultimoMensaje =  $BotDetail->last_message;
            $cerrarElChat = $BotDetail->close_chat;
            WebhooksTwilioController::actionRespuestaCliente($header->id, $company, $determinar->bot_detail_id, $MESSAGE, $customer, $latitudRecive, $longitudRecive);
            $data = [
                'company_id' => $company,
                'date_created' => date('Y-m-d'),
                'chat_bot_header_id' =>  $chatHeader->id,
                'customer_answer' => $MESSAGE,
                'description' => 'Mensaje Paciente',
                'bot_detail_id' => $determinar->bot_detail_id,
                'api_header_id' => $apiHeader,
                'first_message' => $respuesta,
                'last_message' => false,
                'bot' => false,
                'date_format' => date('Y-m-d H:i:s'),
                'status' => true,
            ];
            ChatBotDetail::create($data);
        }

        $dataRespuesta = [
            'respuesta' => $respuesta,
            'ultimoMensaje' => $ultimoMensaje,
            'cerrarElChat' => $cerrarElChat,
            'apiHeader' => $apiHeader,
        ];
        return $dataRespuesta;
    }

    public static function closeBotIsLast($chatBotHeader, $last_message, $customerID)
    {
        if ($last_message) {
            $chatBotHeader = ChatBotHeader::find($chatBotHeader);
            //****** QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ******//
            $company = Company::find($chatBotHeader->company_id);
            if ($company->principal == false) {
                $customer = Customer::find($customerID);
                $customer->sede_id = null;
                $customer->company_assigned_id = null;
                $customer->save();
            }
            //**** FIN QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ****//
            $chatBotHeader->status = false;
            $chatBotHeader->save();
        }
    }

    public static function closeBotLast($chatBotHeader, $customerID)
    {
        $chatBotHeader = ChatBotHeader::find($chatBotHeader);
        //****** QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ******//
        $company = Company::find($chatBotHeader->company_id);
        if ($company->principal == false) {
            $customer = Customer::find($customerID);
            $customer->sede_id = null;
            $customer->company_assigned_id = null;
            $customer->save();
        }
        //**** FIN QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ****//
        $company = $chatBotHeader->company_id;
        $chatBotHeader->status = false;
        $chatBotHeader->save();
    }

    public static function dirigirAgente($chatBotHeader)
    {
        $chatBotHeader = ChatBotHeader::find($chatBotHeader);
        $chatBotHeader->agente = true;
        $chatBotHeader->status = true;
        $chatBotHeader->save();
    }

    public static function guardarCamposConAlias($api, $chatHeaderID, $mensajeEnviado)
    {


        // $data = [
        //     'name' => 'fase 1'
        // ];
        // Region::create($data);




        $apiHeader = ApiHeader::find($api);
        $existe = ApiDetail::where('api_header_id', $api)->whereNotNull('alias');
        if ($existe->count() !== 0) {

            $detalle = ApiDetail::where('api_header_id', $api)->whereNotNull('alias')->first();
            $botCustomerResponse = BotCustomerResponse::where('chat_bot_header_id', $chatHeaderID)->where('api_header_id', $api);

            if ($botCustomerResponse->count() == 0) {
                $data1 = [
                    'chat_bot_header_id' => $chatHeaderID,
                    'api_header_id' => $api,
                    'date_created' => date('Y-m-d'),
                    'table_name' => is_null($apiHeader->table_name) ? null : $apiHeader->table_name,
                    'campo_name' => $detalle->alias,
                    'index_response' => $mensajeEnviado,
                    'response_customer' => $mensajeEnviado,
                    'status' => true,
                ];
                BotCustomerResponse::create($data1);
            } else {

                $botCustomerResponse = BotCustomerResponse::where('chat_bot_header_id', $chatHeaderID)->where('api_header_id', $api)->first();

                // if($botCustomerResponse->){

                // }

                $indexSeleccionado = "";
                $textSeleccionado = "";
                $selection = intval($mensajeEnviado);
                $i = 1;
                foreach (json_decode($botCustomerResponse->json_response) as $value) {
                    if ($i == $selection) {
                        // Convertir en array //
                        $arrayObject = get_object_vars($value);
                        // Tomar indices //
                        $indices = array_keys($arrayObject);
                        // Con indices probar en objeto //
                        $uno = $indices[0];
                        $dos = $indices[1];
                        $indexSeleccionado = $value->$uno;
                        $textSeleccionado = $value->$dos;
                    }
                    $i++;
                }
                $botCustomerResponse->table_name = (is_null($apiHeader->table_name)) ? null : $apiHeader->table_name;
                $botCustomerResponse->campo_name = $detalle->alias;
                $botCustomerResponse->index_response = $mensajeEnviado;
                $botCustomerResponse->response_opcion = $textSeleccionado;
                $botCustomerResponse->response_customer = $indexSeleccionado;
                $botCustomerResponse->status = true;
                $botCustomerResponse->save();
            }
        }
    }

    public static function sedeMasCercana($chatBotHeader, $customerID)
    {
        $existe = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeader)->where('table_name', 'customer_address')->where('status', true);
        $existeSede = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeader)->where('table_name', 'sede')->where('status', true);

        if ($existe->count() || $existeSede->count()) {
            $existeSedeGuardada = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeader)
                ->where('table_name', 'sede')
                ->where('status', true)
                ->orderBy('id', 'DESC');


            if ($existeSedeGuardada->count()) {
                $respuestas = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeader)
                    ->where('table_name', 'sede')
                    ->where('status', true)
                    ->orderBy('id', 'DESC')
                    ->first();

                $sede = Sede::find($respuestas->response_customer);
                $customer = Customer::find($customerID);
                $customer->sede_id = $sede->code_intel;
                $customer->company_assigned_id = $sede->company_id;
                $customer->save();
            } else {
                $direccion = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeader)
                    ->where('table_name', 'customer_address')
                    ->where('status', true)
                    ->orderBy('id', 'DESC')
                    ->first();
                $customerAddress = CustomerAddress::find($direccion->response_customer);

                //**** Cambio de Company segun localización ****//
                $latitud = $customerAddress->latitud;
                $longitud = $customerAddress->longitud;
                $menor_distance = '';
                $sede_selected = '';
                $company_selected = '';
                $sedes = Sede::where('status', true)->get();
                foreach ($sedes as $key => $com) {
                    if ($com->latitud !== null && $com->latitud !== '' && $com->longitud !== null && $com->longitud !== '') {
                        $url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' . $longitud . ',' . $latitud . ';' . $com->longitud . ',' . $com->latitud . '?overview=false&alternatives=true&steps=true&access_token=pk.eyJ1IjoiZmFyYWRheTIiLCJhIjoiTUVHbDl5OCJ9.buFaqIdaIM3iXr1BOYKpsQ';
                        $options = stream_context_create([
                            'http' => [
                                'method' => 'GET',
                                'header' => 'Content-type: application/json'
                            ]
                        ]);
                        $result = file_get_contents($url, false, $options);
                        $resultObject = json_decode($result);
                        $distance = $resultObject->routes[0]->distance;
                        if ($key == 0) {
                            $menor_distance = $distance;
                            $sede_selected = $com->code_intel;
                            $company_selected = $com->company_id;
                        } else {
                            if ($menor_distance >= $distance) {
                                $menor_distance = $distance;
                                $sede_selected = $com->code_intel;
                                $company_selected = $com->company_id;
                            }
                        }
                    }
                    $customer = Customer::find($customerID);
                    $customer->sede_id = $sede_selected;
                    $customer->company_assigned_id = $company_selected;
                    $customer->save();
                }
                //**** FinCambio de Company segun localización ****//
            }
        }
    }
}
