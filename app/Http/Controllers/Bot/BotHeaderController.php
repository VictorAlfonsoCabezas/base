<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Models\ApiDetail;
use App\Models\BotDetail;
use App\Models\BotHeader;
use App\Models\BotHistorial;
use App\Models\ApiHeader;
use App\Models\ApiParameters;
use App\Models\ChatBotDetail;
use App\Models\Company;
use App\Models\BotIntention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class BotHeaderController extends Controller
{
    public function index()
    {
        $company = Company::all();
        return view('bot/index')
            ->with('company', $company);
    }

    public function show($id)
    {
        $header = BotHeader::where('company_id', $id)->get();
        return Response::json($header);
    }

    public function edit($id)
    {
        $detalle = BotDetail::where('bot_header_id', $id)->count();
        $data = [
            'detalle' => $detalle,
            'header' => $id
        ];
        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $detalle = BotDetail::find($id);
        $detalle->description = ($request->input('text') !== null) ? $request->input('text') : '';
        $detalle->save();
        return Response::json($detalle->bot_header_id);
    }

    public function destroy($id)
    {
        $detalle = BotDetail::find($id);
        BotHistorial::where('company_id', $detalle->company_id)
            ->where('bot_header_id', $detalle->bot_header_id)
            ->where('bot_detail_id', $detalle->id)
            ->delete();
        BotHeaderController::BorrarHistorialesRelacionados($detalle);
        BotDetail::find($id)->delete();
        BotHeaderController::SearchLastMessage($detalle->bot_header_id);
        return Response::json($detalle->bot_header_id);
    }

    public function showOption($id)
    {
        $detail = BotDetail::find($id);
        $opciones = BotDetail::where('bot_header_id', $detail->bot_header_id)->where('status', true)->get();
        $historiales = BotHistorial::where('bot_header_id', $detail->bot_header_id)->where('bot_detail_id', $id)->where('status', true)->get();
        $data = [
            'opciones' => $opciones,
            'historiales' => $historiales
        ];
        return Response::json($data);
    }

    public function deleteHistorial($id)
    {
        $detail = BotHistorial::find($id)->bot_detail_id;
        BotHistorial::find($id)->delete();
        return Response::json($detail);
    }

    public function store(Request $request)
    {
        $max = BotDetail::where('bot_header_id', $request->input('header'))->where('status', true)->max('order');
        $first = BotHeaderController::FirstMessage($request->input('header'));
        $last = BotHeaderController::LastMessage($request->input('header'));
        $data = [
            'company_id' => $request->input('company'),
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'description' => '',
            'intention_id' => 3,
            'option' => false,
            'main_branch' => true,
            'first_message' => $first,
            'last_message' => $last,
            'order' => $max + 1,
            'status' => 1
        ];
        $detalle = BotDetail::create($data);

        // $historialNuevo = New BotHistorial();
        // $historialNuevo->company_id = $detalle->company_id ;
        // $historialNuevo->date_created = date('Y-m-d');
        // $historialNuevo->bot_header_id = $detalle->bot_header_id;
        // $historialNuevo->bot_detail_id = $detalle->id;
        // $historialNuevo->status = true;
        // $historialNuevo->save();



        //****** DETALLE ANTERIOR CON PROXIMO ID ******//
        if (!$first) {
            BotHeaderController::DeterminarAnteriorDetalle($detalle);
        }
        //**** FIN DETALLE ANTERIOR CON PROXIMO ID ****//
        return Response::json($request->input('header'));
    }

    public function editHistorial(Request $request, $id)
    {
        $historial = BotHistorial::find($id);
        $historial->opcion = $request->input('opcion');
        $historial->description = $request->input('text');
        $historial->main_answer_id = $request->input('main_answer_id');
        $historial->order = $request->input('order');
        $historial->save();
        return Response::json($historial);
    }

    public function createHistorial(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'opcion' => '',
            'description' => '',
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function createHistorialApi(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'api_header_id' => $request->input('api'),
            'api_parameters_id' => $request->input('api_parameters_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function createHistorialResponsePersonal(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'description' => $request->input('text'),
            'main_answer_id' => $request->input('main_answer_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function createDisabledHistorialApi(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'main_answer_id' => $request->input('main_answer_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function createSmartLinkHistorialApi(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'main_answer_id' => $request->input('main_answer_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }
    // ***********************
    public function createFechaAgenda(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'main_answer_id' => $request->input('main_answer_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function createEnvioInmediato(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'main_answer_id' => $request->input('main_answer_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function createPagoKushki(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        BotHistorial::where('company_id', $company)->where('bot_header_id', $request->input('header'))->where('bot_detail_id', $request->input('detail'))->delete();
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'main_answer_id' => $request->input('main_answer_id'),
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }
    // ******************************/
    public function mensajeCierre(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->close_chat = ($detail->close_chat == true) ? false : true;
        $detail->save();
        return Response::json($detail->bot_header_id);
    }

    public function envioInmediato(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->send_inmediately = ($detail->send_inmediately == true) ? false : true;
        $detail->save();
        return Response::json($detail->bot_header_id);
    }

    public function envioHome(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->home = ($detail->home == true) ? false : true;
        $detail->save();
        return Response::json($detail->bot_header_id);
    }

    public function envioHomePrincipal(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->home_principal = ($detail->home_principal == true) ? false : true;
        $detail->save();
        return Response::json($detail->bot_header_id);
    }

    public function envioBack(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->back = ($detail->back == true) ? false : true;
        $detail->save();
        return Response::json($detail->bot_header_id);
    }

    public function envioAgent(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->agent_start = ($detail->agent_start == true) ? false : true;
        $detail->save();
        return Response::json($detail->bot_header_id);
    }

    public function updateOption(Request $request)
    {
        $detail = BotDetail::find($request->input('detail'));
        $detail->intention_id = $request->input('option');
        $detail->save();
        BotHistorial::where('bot_header_id', $detail->bot_header_id)->where('bot_detail_id', $detail->id)->where('status', true)->delete();
        $historialNuevo = new BotHistorial();
        $historialNuevo->company_id = $detail->company_id;
        $historialNuevo->date_created = date('Y-m-d');
        $historialNuevo->bot_header_id = $detail->bot_header_id;
        $historialNuevo->bot_detail_id = $request->input('detail');
        $historialNuevo->api_header_response = '';
        $historialNuevo->opcion = '';
        $historialNuevo->description = '';
        $historialNuevo->status = true;
        $historialNuevo->save();
        return Response::json($detail->bot_header_id);
    }

    public function verIntencionSeleccionada(Request $request)
    {
        $detail = BotDetail::find($request->input('detalle'));
        $intention = BotIntention::where('status', true)->get();
        $data = [
            'respuesta' => $detail->intention_id,
            'intention' => $intention,
        ];

        return Response::json($data);
    }

    public function verDetalleIntencion(Request $request)
    {
        $intention = BotIntention::find($request->input('intencion'));
        return Response::json($intention);
    }

    public function showApis($company, $api)
    {
        $apis = ApiHeader::where('company_id', $company)->where('status', true)->get();
        $parameters = ApiParameters::where('company_id', $company)->where('api_header_id', $api)->where('status', true)->get();
        return Response::json([
            'apis' => $apis,
            'api_parameters' => $parameters
        ]);
    }

    public function showParametersApi($id)
    {
        $header = ApiHeader::find($id);
        $detail = ApiDetail::where('company_id', $header->company_id)->where('api_header_id', $header->id)->where('status', true)->get();
        $parameters = ApiParameters::where('company_id', $header->company_id)->where('api_header_id', $header->id)->where('status', true)->get();
        return Response::json([
            'api_detail' => $detail,
            'api_parameters' => $parameters
        ]);
    }

    public function createHeader(Request $request)
    {
        $data = [
            'company_id' => $request->input('company'),
            'date_created' => date('Y-m-d'),
            'name' => strtoupper($request->input('name')),
            'description' => strtoupper($request->input('description')),
            'start_code' => $request->input('start_code'),
            'home_codigo' => $request->input('home_codigo'),
            'home_texto' => $request->input('home_texto'),
            'back_codigo' => $request->input('back_codigo'),
            'back_texto' => $request->input('back_texto'),
            'user_created_id' => Auth::user()->id,
            'status' => true
        ];
        BotHeader::create($data);
        $header = BotHeader::where('company_id', $request->input('company'))->get();
        return Response::json($header);
    }

    public function updateHeader(Request $request)
    {
        $botHeader = BotHeader::find($request->input('header'));
        $botHeader->name = strtoupper($request->input('name'));
        $botHeader->description = strtoupper($request->input('description'));
        $botHeader->start_code = $request->input('start_code');
        $botHeader->home_codigo = $request->input('home_codigo');
        $botHeader->home_texto = $request->input('home_texto');
        $botHeader->back_codigo = $request->input('back_codigo');
        $botHeader->back_texto = $request->input('back_texto');
        $botHeader->save();
        $headers = BotHeader::where('company_id', $request->input('company'))->get();
        return Response::json($headers);
    }

    public function deleteHistorialMSP($id)
    {
        $detail = BotHistorial::find($id)->bot_detail_id;
        BotHistorial::find($id)->delete();
        return Response::json($detail);
    }

    public function editHistorialMSP(Request $request, $id)
    {
        $historial = BotHistorial::find($id);
        $historial->api_header_code = $request->input('api_header_code');
        $historial->description = $request->input('text');
        $historial->main_answer_id = $request->input('main_answer_id');
        $historial->save();
        return Response::json($historial->bot_detail_id);
    }

    public function createHistorialMSP(Request $request)
    {
        $company = BotHeader::find($request->input('header'))->company_id;
        $data = [
            'company_id' => $company,
            'date_created' => date('Y-m-d'),
            'bot_header_id' => $request->input('header'),
            'bot_detail_id' => $request->input('detail'),
            'api_header_code' => '',
            'description' => '',
            'status' => true,
        ];
        $historial = BotHistorial::create($data);
        return Response::json($historial);
    }

    public function desactivarBot($id)
    {
        $bot = BotHeader::find($id);
        $bot->status = ($bot->status == true) ? false : true;;
        $bot->save();
        $header = BotHeader::where('company_id', $bot->company_id)->get();
        return Response::json($header);
    }

    public function showHeader($id)
    {
        $header = BotHeader::find($id);
        return Response::json($header);
    }

    public function showDetail($id)
    {
        $detail = BotDetail::find($id);
        return Response::json($detail);
    }

    public function showIntenciones($id)
    {
        $detail = BotDetail::find($id);
        $intention = BotIntention::find($detail->intention_id);
        return Response::json($intention);
    }

    public function showHistorial($detalle)
    {
        $historial = BotHistorial::where('bot_detail_id', $detalle)->where('status', true)->get();
        return Response::json($historial);
    }

    public function showHistorialApi($detalle)
    {
        $detail = BotDetail::find($detalle);
        $historial = BotHistorial::where('bot_detail_id', $detalle)->where('status', true)->get();
        $apis = ApiHeader::where('company_id', $detail->company_id)->where('status', true)->get();
        $data = [
            'historial' => $historial,
            'apis' => $apis
        ];
        return Response::json($data);
    }

    public function crearProximoMensaje(Request $request)
    {
        $historial = BotHistorial::find($request->input('historial'));
        $historial->main_answer_id = $request->input('main_answer_id');
        $historial->save();
        return Response::json($historial->bot_header_id);
    }

    public function addDetalles($header)
    {
        $cabecera = BotHeader::find($header);
        $detalles = BotDetail::where('bot_header_id', $header)->get();
        foreach ($detalles as $value) {
            $existe = BotHistorial::where('bot_header_id', $value->bot_header_id)->where('bot_detail_id', $value->id)->where('status', true);
            if ($existe->count() == 1) {
                $historial = BotHistorial::where('bot_header_id', $value->bot_header_id)->where('bot_detail_id', $value->id)->where('status', true)->first();
                $detalleProximo = BotDetail::find($historial->main_answer_id);
                $value->proximoMensaje = isset($detalleProximo->description) ? $detalleProximo->description : '';
            } else if ($existe->count() > 1) {
                $value->proximoMensaje = 'Mensaje multiples Opciones';
            } else {
                $value->proximoMensaje = 'Sin Asignar';
            }

            $value->home_texto = $cabecera->home_texto;
            $value->back_texto = $cabecera->back_texto;
        }
        return Response::json($detalles);
    }

    public function saveFileModal(Request $request, $detail)
    {
        $BoteDetail = BotDetail::find($detail);
        $image = $request->file('fileOne');
        $imageName = time() . '.' . $image->extension();
        $rutaCarpetas = "/uploads/bots/" . $BoteDetail->company_id . "/" . $BoteDetail->bot_header_id . "/";
        $rutaCompany = public_path($rutaCarpetas);
        if (!File::isDirectory($rutaCompany)) {
            File::makeDirectory($rutaCompany, 0777, true, true);
        }
        $image->move($rutaCompany, $imageName);
        $BoteDetail->path_file = $rutaCarpetas;
        $BoteDetail->name_file = $imageName;

        $imageName = $BoteDetail->name_file;
        $temp = explode('.', $imageName);
        $extension = end($temp);

        $BoteDetail->file_extention = $extension;
        $BoteDetail->save();
        return response()->json($BoteDetail->bot_header_id);
    }

    //****    FUNCIONES ESTÁTICAS    ****//
    public static function FirstMessage($header)
    {
        $detalles = BotDetail::where('bot_header_id', $header)->where('status', true)->count();
        if ($detalles) {
            $respuesta = false;
        } else {
            $respuesta = true;
        }
        return $respuesta;
    }

    public static function LastMessage($header)
    {
        $detalles = BotDetail::where('bot_header_id', $header)->where('status', true);
        if ($detalles->count()) {
            foreach ($detalles->get() as $value) {
                $detalle = BotDetail::find($value->id);
                if ($detalle->last_message) {
                    $detalle->last_message = false;
                    $detalle->save();
                }
            }
        }
        return true;
    }

    public static function SearchLastMessage($header)
    {
        $ultimo = BotDetail::where('bot_header_id', $header)->where('status', true)->max('id');
        if (isset($ultimo)) {
            $detalle = BotDetail::find($ultimo);
            if (!$detalle->last_message) {
                $detalle->last_message = true;
                $detalle->save();
            }
        }
    }

    public static function DeterminarAnteriorDetalle($detalle)
    {
        $botDetailAnterior = BotDetail::where('bot_header_id', $detalle->bot_header_id)
            ->whereNotIn('id', [$detalle->id])
            ->where('status', true)
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get();

        if (isset($botDetailAnterior[0]->id)) {
            $BotHistorial = BotHistorial::where('bot_header_id', $detalle->bot_header_id)
                ->where('bot_detail_id', $botDetailAnterior[0]->id)
                ->where('status', true);
            if ($BotHistorial->count() == 0) {
                $data = [
                    'company_id' => $detalle->company_id,
                    'date_created' => date('Y-m-d'),
                    'bot_header_id' => $detalle->bot_header_id,
                    'bot_detail_id' => $botDetailAnterior[0]->id,
                    'main_answer_id' => $detalle->id,
                    'status' => true,
                ];
                $botDetail = BotDetail::find($botDetailAnterior[0]->id);
                $botDetail->disabled = true;
                $botDetail->save();
                BotHistorial::create($data);
            }
        }
    }

    public static function BorrarHistorialesRelacionados($detalle)
    {
        $mainAnswer = BotHistorial::where('company_id', $detalle->company_id)
            ->where('bot_header_id', $detalle->bot_header_id)
            ->where('main_answer_id', $detalle->id);
        foreach ($mainAnswer->get() as $value) {
            BotHistorial::find($value->id)->delete();
        }
    }

    //****  FIN FUNCIONES ESTÁTICAS  ****//
}
