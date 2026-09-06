<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kushki\KushkiController;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class WebhooksController extends Controller
{
    public static function webhooks(Request $request)
    {
        $whatsapp = $request->input('messages');
        //** Solo mensajes a mi telefono **//
        $authorJohn = $whatsapp[0]['author'];
        $receptorJohn = str_replace('@c.us', '', $authorJohn);
        $grupos = substr($whatsapp[0]['chatId'], -5);
        $repuesta2 = false;
        //**** De esta manera que no se envie de grupos ****//
        if ($grupos !== '@g.us') {
            if ($receptorJohn !== '593985974005') {
                $customer = Customer::where('celular_1', $receptorJohn);


                if ($customer->count() > 0) {
                    $customer = $customer->first();
                    //****** VERIFICAR SI TIENE UNA ASIGNADA ******//
                    if ($customer->company_assigned_id !== null && $customer->company_assigned_id !== '') {
                        //****** QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ******//
                        $existeChatsPrincipal = ChatBotHeader::where('company_id', $customer->company_id)->where('customer_id', $customer->id)->where('status', true);
                        if ($existeChatsPrincipal->count() > 0) {
                            $empresa = $customer->company_id;
                        } else {
                            $empresa = $customer->company_assigned_id;
                        }
                        //**** FIN QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ****//
                    } else {
                        $empresa = $customer->company_id;
                    }
                    //**** FIN VERIFICAR SI TIENE UNA ASIGNADA ****//
                } else {
                    $empresaPrincipal = Company::where('principal', true)->where('chat_api', true)->where('status', true)->first();
                    $data = [
                        'company_id' => $empresaPrincipal->id,
                        'name' => $whatsapp[0]['chatName'],
                        'celular_1' => $receptorJohn,
                        'status' => true
                    ];
                    $customer = Customer::create($data);
                    $empresa = $customer->company_id;
                }

                $company = $empresa;
                if ($customer->numero_documento == null) {
                    $empty_customer = true;
                } else {
                    $empty_customer = false;
                }

                //ELEGIR CAMPAÑA
                $campania = BotHeader::where('company_id', $company)
                    ->where('status', true)
                    ->where('start_code', $whatsapp[0]['body']);
                if ($campania->count() > 0) {
                    $header = $campania->first();
                } else {
                    $bots = ChatBotHeader::where('customer_id', $customer->id)
                        ->where('status', true);
                    if ($bots->count() > 0) {
                        $chatBotHeader = $bots->first();
                        $header = BotHeader::find($chatBotHeader->bot_header_id);
                    } else {
                        $header = BotHeader::where('company_id', $company)
                            ->where('status', true)
                            ->first();
                    }
                }
                //FIN ELEGIR CAMPAÑA
                if ($whatsapp[0]['fromMe'] == null) {
                    $chatHeader = ChatBotHeader::where('company_id', $company)
                        ->where('bot_header_id', $header->id)
                        ->where('status', true);
                    if ($chatHeader->count() == 0) {
                        $data = [
                            'company_id' => $company,
                            'date_created' => date('Y-m-d'),
                            'bot_header_id' =>  $header->id,
                            'customer_id' =>  $customer->id,
                            'name' => $whatsapp[0]['senderName'],
                            'description' => 'Menssage Default',
                            'chatId' => $whatsapp[0]['chatId'],
                            'status' => true,
                        ];
                        $chatHeader = ChatBotHeader::create($data);
                    } else {
                        $chatHeader = ChatBotHeader::where('company_id', $company)
                            ->where('bot_header_id', $header->id)
                            ->where('status', true)
                            ->first();
                    }
                    //****** CREAR CUSTOMER Y COMPANY POR DEFECTO ******//
                    $botCustomerResponse = BotCustomerResponse::where('chat_bot_header_id', $chatHeader->id)->where('status', true);
                    if ($botCustomerResponse->count() == 0) {
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
                    }
                    //**** FIN CREAR CUSTOMER Y COMPANY POR DEFECTO ****//
                    $first = WebhooksController::isFirstMessage($company, $chatHeader->id);
                    $respuestaCerrar = false;
                    $respuestaCerrarChat = false;
                    if ($first) {
                        $data = [
                            'company_id' => $company,
                            'date_created' => date('Y-m-d'),
                            'chat_bot_header_id' =>  $chatHeader->id,
                            'customer_answer' => $whatsapp[0]['body'],
                            'description' => 'Mensaje Paciente',
                            'first_message' => $first,
                            'last_message' => false,
                            'bot' => false,
                            'date_format' => $whatsapp[0]['time'],
                            'messagenumber' => $whatsapp[0]['messageNumber'],
                            'status' => true,
                        ];
                        $respuestaCliente = ChatBotDetail::create($data);
                    } else {
                        $determinar = ChatBotDetail::where('company_id', $company)
                            ->where('chat_bot_header_id', $chatHeader->id)
                            ->where('bot', true)
                            ->where('status', true)
                            ->orderBy('id', 'DESC')
                            ->first();
                        $BotDetail = BotDetail::find($determinar->bot_detail_id);
                        $apiHeader = null;



                        if ($BotDetail->api) {
                            $BotHistorial = BotHistorial::where('bot_detail_id', $BotDetail->id)
                                ->where('company_id', $company)
                                ->where('status', true)
                                ->first();
                            $apiHeader = (isset($BotHistorial)) ? $BotHistorial->api_header_id : null;
                            if (isset($BotHistorial)) {
                                $apiHeader = $BotHistorial->api_header_id;
                                //****** GUARDAR BOT CUSTOMER INFORMATION ******//
                                WebhooksController::guardarCamposConAlias($apiHeader, $chatHeader->id, $whatsapp[0]['body']);
                                //**** FIN GUARDAR BOT CUSTOMER INFORMATION ****//
                            } else {
                                $apiHeader = null;
                            }
                        }
                        $respuestaCerrar =  $BotDetail->last_message;
                        $respuestaCerrarChat = $BotDetail->close_chat;
                        WebhooksController::actionRespuestaCliente($header->id, $company, $determinar->bot_detail_id, $whatsapp[0]['body'], $customer->id, $empty_customer);
                        $data = [
                            'company_id' => $company,
                            'date_created' => date('Y-m-d'),
                            'chat_bot_header_id' =>  $chatHeader->id,
                            'customer_answer' => $whatsapp[0]['body'],
                            'description' => 'Mensaje Paciente',
                            'bot_detail_id' => $determinar->bot_detail_id,
                            'api_header_id' => $apiHeader,
                            'first_message' => $first,
                            'last_message' => false,
                            'bot' => false,
                            'date_format' => $whatsapp[0]['time'],
                            'messagenumber' => $whatsapp[0]['messageNumber'],
                            'status' => true,
                        ];
                        $respuestaCliente = ChatBotDetail::create($data);
                    }
                    if ($respuestaCerrar and $respuestaCerrarChat) {
                        WebhooksController::closeBotLast($chatHeader->id, $customer->id);
                    } else {
                        $detailNew = WebhooksController::lastDetail($header->id, $company, $whatsapp[0]['body'], $customer->id, $empty_customer, $first);
                        if ($detailNew['detalle']) {
                            $detalleNew = BotDetail::find($detailNew['detalle']);
                            if (!$detailNew['respuesta']) {
                                WebhooksController::closeBotIsLast($chatHeader->id, $detalleNew->last_message, $customer->id);
                            }
                            if ($detalleNew->close_chat) {
                                WebhooksController::closeBotLast($chatHeader->id, $customer->id);
                            }
                            $mensaje = $detailNew['mensaje'];
                            $author = $whatsapp[0]['author'];
                            $receptor = str_replace('@c.us', '', $author);
                            WebhooksController::newWhatsapp($receptor, $mensaje);
                            $data = [
                                'company_id' => $company,
                                'date_created' => date('Y-m-d'),
                                'chat_bot_header_id' =>  $chatHeader->id,
                                'bot_detail_id' => $detalleNew->id,
                                'bot_question' => $mensaje,
                                // 'customer_answer' => $whatsapp[0]['body'],
                                'description' => 'Interaccion desde el Cliente con el BOT',
                                'last_message' => true,
                                'bot' => true,
                                'date_format' => $whatsapp[0]['time'],
                                'messagenumber' => $whatsapp[0]['messageNumber'],
                                'status' => $detailNew['mensajeError'],
                            ];
                            ChatBotDetail::create($data);
                        } else {
                            $mensaje = $detailNew['mensaje'];
                            $author = $whatsapp[0]['author'];
                            $receptor = str_replace('@c.us', '', $author);
                            WebhooksController::newWhatsapp($receptor, $mensaje);
                            $data = [
                                'company_id' => $company,
                                'date_created' => date('Y-m-d'),
                                'chat_bot_header_id' =>  $chatHeader->id,
                                'bot_question' => $mensaje,
                                // 'customer_answer' => $whatsapp[0]['body'],
                                'description' => 'Interaccion desde el Cliente con el BOT',
                                'last_message' => true,
                                'bot' => true,
                                'date_format' => $whatsapp[0]['time'],
                                'messagenumber' => $whatsapp[0]['messageNumber'],
                                'status' => $detailNew['mensajeError'],
                            ];
                            ChatBotDetail::create($data);
                        }
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
        }
    }

    //****   FUNCIONES ESTATICAS    ****//
    public static function newWhatsapp($receptor, $cuerpo)
    {
        $empresa = Company::where('principal', true)->first();
        // $instance = '328730';
        $instance = $empresa->instancia;
        // $token = '95yo4qmlodpheo40';
        $token = $empresa->token_chatapi;
        $data = [
            'phone' => $receptor,
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
        return true;
    }

    public static function newWhatsappButtons($receptor, $botones, $cuerpo)
    {
        $empresa = Company::where('principal', true)->first();
        // $instance = '328730';
        $instance = $empresa->instancia;
        // $token = '95yo4qmlodpheo40';
        $token = $empresa->token_chatapi;
        $data = [
            'phone' => $receptor,
            'title' => 'Elije una Opción',
            'body' => $cuerpo,
            'footer' => 'Thank you',
            'buttons' => $botones
        ];
        $json = json_encode($data);
        $url = 'https://api.chat-api.com/instance' . $instance . '/sendButtons?token=' . $token;
        $options = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        $result = file_get_contents($url, false, $options);
        return true;
    }

    public static function lastDetail($headerId, $company, $mensajeWhatsapp, $customer_id, $empty_customer, $first)
    {
        $respuesta = false;
        $mensajeArray = [];
        $button = '';
        $cuerpo = '';
        $respuestaErronea = true;
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
        } else {
            $chatDetalle = ChatBotDetail::where('company_id', $company)
                ->where('chat_bot_header_id', $chatHeader->id)
                ->where('bot', true)
                ->where('status', true)
                ->orderBy('id', 'DESC')
                ->first();
            if ($chatDetalle->botDetail->option) {
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
            } else {
                $historiales = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $headerId)
                    ->where('bot_detail_id', $chatDetalle->bot_detail_id)
                    ->where('status', true);
                $historial = $historiales->first();
                $detailSiguiente = BotDetail::find($historial->main_answer_id);
                $detalle = $detailSiguiente->id;
            }
        }





        if ($historiales == false) {
            $opcion = 'SN';
        } else if ($detailSiguiente->option) {
            $opcion = 'OP';
        } else if ($detailSiguiente->api) {
            $opcion = 'AP';
        } else if ($detailSiguiente->refresh) {
            $opcion = 'RE';
        } else if ($detailSiguiente->location) {
            $opcion = 'LO';
        } else if ($detailSiguiente->location_description) {
            $opcion = 'LOD';
        } else if ($detailSiguiente->api_response) {
            $opcion = 'APR';
        } else if ($detailSiguiente->personalized_response) {
            $opcion = 'APRE';
        } else if ($detailSiguiente->guardado) {
            $opcion = 'GUCAM';
        } else if ($detailSiguiente->guardar_api) {
            $opcion = 'GU';
        } else if ($detailSiguiente->smart_link_pay) {
            $opcion = 'SL';
        } else {
            $opcion = 'DE';
        }


        $region = [
            'name' => 'opcion: ' . $opcion
        ];
        Region::create($region);

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
                        $array = json_decode(json_encode($resultObject->data), true);
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

                            $sql = "SELECT $campos FROM $TABLE";
                            $url = $api->api_link;
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
                            $resultObject = json_decode($result);
                            $array = json_decode(json_encode($resultObject), true);
                        } else {
                            $array = [];
                            $company = Company::find($api->company_id);
                            $parameters = ApiParameters::where('company_id', $api->company_id)
                                ->where('api_header_id', $api->id)
                                ->get();
                            if (count($parameters) > 0) {
                                $url = $api->api_link;
                                $data = [
                                    'fecha' => date('Y-m-d'),
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
                                $resultObject = json_decode($result);
                                $array = json_decode(json_encode($resultObject), true);
                            }
                        }
                    }
                    foreach ($array as $key => $value) {
                        $indices = array_keys($value);
                        $i = 0;
                        while (isset($indices[$i])) {
                            $campo = $indices[$i];
                            if ($i == 0) {
                                $mensaje .= "\n" . '*' . $value[$campo] . '*';
                            } else {
                                $mensaje .= ' ' . $value[$campo];
                            }
                            $i++;
                        }
                    }
                }
                break;


            case 'RE':
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

                $historial = BotHistorial::where('company_id', $company)
                    ->where('bot_header_id', $detalleNew->bot_header_id)
                    ->where('bot_detail_id', $detalleNew->id)
                    ->where('status', true)
                    ->first();
                $texto = '';
                $texto .= $mensaje . '' . $historial->description;
                $centinela = true;
                $region = [
                    'name' => 'entraatexto: ' . $texto
                ];
                Region::create($region);
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
                KushkiController::crearPacienteAtencionPrefacturaFacturaSigcenter($company, $customer_id, $linkInfo['precio']);
                $mensaje .= "\n" . $linkInfo['link'];
                break;

            case 'SN':
                $respuestaErronea = false;
                $mensaje = '😔 Lo siento no puedo entenderte';
                break;

            case 'DE':
                $detalleNew = BotDetail::find($detalle);
                $mensaje = $detalleNew->description;
                break;
        }

        $data = [
            'detalle' => (isset($detalleNew->id) ? $detalleNew->id : false),
            'mensaje' => $mensaje,
            'mensajeArray' => $mensajeArray,
            'cuerpo' => $cuerpo,
            'respuesta' => $respuesta,
            'mensajeError' => $respuestaErronea
        ];
        return $data;
    }

    public static function actionRespuestaCliente($headerId, $company, $botDetailId, $mensajeWhatsapp, $customer_id, $empty_customer)
    {
        $chatHeader = ChatBotHeader::where('company_id', $company)
            ->where('bot_header_id', $headerId)
            ->where('status', true)
            ->first();

        $botDetail = BotDetail::find($botDetailId);

        if ($botDetail->option) {
            $opcion = 'OP';
            //OPV respuesta segun lo escrito
        } else if ($botDetail->option) {
            $opcion = 'OPV';
        } else if ($botDetail->api) {
            $opcion = 'AP';
        } else if ($botDetail->refresh) {
            $opcion = 'RE';
        } else if ($botDetail->location) {
            $opcion = 'LO';
        } else if ($botDetail->location_description) {
            $opcion = 'LOD';
        } else if ($botDetail->api_response) {
            $opcion = 'APR';
        } else if ($botDetail->personalized_response) {
            $opcion = 'APRE';
        } else if ($botDetail->guardado) {
            $opcion = 'GUCAM';
        } else if ($botDetail->guardar_api) {
            $opcion = 'GU';
        } else if ($botDetail->smart_link_pay) {
            $opcion = 'SL';
        } else {
            $opcion = 'DE';
        }

        // $region = [
        //     'name' => 'opcion RESPUESTS: ' . $opcion
        // ];
        // Region::create($region);

        switch ($opcion) {
            case 'OP':

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
                    //**** dividir coordenadas ****//
                    $valor = $mensajeWhatsapp;
                    $primera = '';
                    for ($i = 0; $i < strlen($valor); $i++) {
                        if ($valor[$i] == ';') {
                            $primera = substr($valor, 0, $i);
                            $final = $i + 1;
                        }
                    }
                    $segunda = substr($valor, $final);
                    //**** Fin dividir coordenadas ****//
                    $data = [
                        'api_header_id' => $api->id,
                        'chat_bot_header_id' => $chatHeader->id,
                        'latitud' => $primera,
                        'longitud' => $segunda
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

                    //**** Cambio de Company segun localización ****//
                    $latitud = $primera;
                    $longitud = $segunda;
                    $menor_distance = '';
                    $company_selected = '';
                    $companies = Company::where('principal', false)
                        ->where('status', true)->get();
                    foreach ($companies as $key => $com) {
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
                                $company_selected = $com->id;
                            } else {
                                if ($menor_distance >= $distance) {
                                    $menor_distance = $distance;
                                    $company_selected = $com->id;
                                }
                            }
                        }
                        $customer = Customer::find($customer_id);
                        $customer->company_assigned_id = $company_selected;
                        $customer->save();
                    }
                    //**** FinCambio de Company segun localización ****//
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
                        'parametro' => $customer_id,
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
                if ($empty_customer) {
                    $ruc = $mensajeWhatsapp;
                    $date = date('d-m-Y');
                    if (strlen($ruc) == 10) {
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
                    } else {
                        //en este caso es otro tipo de identificacion
                    }
                    if (isset($nombres) && isset($apellidos) && isset($pacienteNombre)) {
                        $fin_espacio = (strpos($nombres, ' '));
                        $soloName = substr($nombres, 0, $fin_espacio);
                        $customer = Customer::find($customer_id);
                        $customer->name = $soloName;
                        $customer->nombres = $nombres;
                        $customer->apellidos = $apellidos;
                        $customer->numero_documento = $mensajeWhatsapp;
                        $customer->birth_date = $pacienteNombre['FECHA_NAC'];
                        $customer->save();
                        $code = '300';
                    } else {
                        $customer = Customer::find($customer_id);
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

            case 'SL':

                break;

            case 'SN':

                break;

            case 'DE':

                break;
        }
    }

    public static function isFirstMessage($company, $chatBotHeaderId)
    {
        $isFirstDetail = ChatBotDetail::where('company_id', $company)->where('chat_bot_header_id', $chatBotHeaderId)->where('status', true);
        if ($isFirstDetail->count()) {
            $respuesta = false;
        } else {
            $respuesta = true;
        }
        return $respuesta;
    }

    public static function closeBotIsLast($chatBotHeader, $last_message, $customerID)
    {
        if ($last_message) {
            $chatBotHeader = ChatBotHeader::find($chatBotHeader);
            //****** QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ******//
            $company = Company::find($chatBotHeader->company_id);
            if ($company->principal == false) {
                $customer = Customer::find($customerID);
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
            $customer->company_assigned_id = null;
            $customer->save();
        }
        //**** FIN QUITAR ASIGNAMIETO DE EMPRESA SI CIERRA DIFERENTE A LA PRINCIPAL ****//
        $company = $chatBotHeader->company_id;
        $chatBotHeader->status = false;
        $chatBotHeader->save();
    }

    public static function guardarCamposConAlias($api, $chatHeaderID, $mensajeEnviado)
    {
        $existe = ApiDetail::where('api_header_id', $api)->whereNotNull('alias');
        if ($existe->count() !== 0) {
            $detalle = ApiDetail::where('api_header_id', $api)->whereNotNull('alias')->first();
            $data1 = [
                'chat_bot_header_id' => $chatHeaderID,
                'api_header_id' => $api,
                'date_created' => date('Y-m-d'),
                // 'table_name' => 'customer',
                'campo_name' => $detalle->alias,
                'response_customer' => $mensajeEnviado,
                'status' => true,
            ];
            BotCustomerResponse::create($data1);
        }
    }

    //**** FIN FUNCIONES ESTATICAS  ****//
}
