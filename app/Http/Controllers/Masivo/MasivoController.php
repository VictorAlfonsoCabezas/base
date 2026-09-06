<?php

namespace App\Http\Controllers\Masivo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseController;
use App\Models\BotHeader;
use App\Models\MassiveHeader;
use App\Models\MassiveDetail;
use App\Models\DateSendMassive;
use Illuminate\Http\Request;
use App\Imports\MasisiveMensajes;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class MasivoController extends Controller {

    public function index() {
        $masivoH = MassiveHeader::where('company_id', Auth::user()->company_id)->get();
        foreach ($masivoH as $val) {
            $bot = BotHeader::find($val->bot_header_id);
            $val->mensajeName = $bot->name;
            $dataTex = '';
            $fechas = DateSendMassive::where('massive_header_id', $val->id)->where('status', true)->get();
            foreach ($fechas as $data) {
                $dataTex = $dataTex . ' - ' . $data->date_created;
            }
            $val->dateSend = $dataTex;


            $nPersonasEnviar = MassiveDetail::where('massive_header_id', $val->id)->where('status', true)->count();
            $nfechas = DateSendMassive::where('massive_header_id', $val->id)->where('status', true)->count();
            $nMensajes = $nPersonasEnviar * $nfechas;
            $nEnviados = MassiveDetail::where('massive_header_id', $val->id)->where('status', true)->sum('envios');
            $porcentaje = ($nEnviados * 100) / $nMensajes;
            $val->porcentaje = $porcentaje;
        }
        return view('massive/index')->with('masivoH', $masivoH);
    }

    public function create() {
        $botHeader = BotHeader::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        $tokem = BaseController::GenerarTokenInterno(10);
        return view('massive/create')->with('tokem', $tokem)->with('botHeader', $botHeader);
    }

    public function cargarArchivo(Request $request) {
        $dataHeader = [
            'company_id' => Auth::user()->company_id,
            'code' => $request->input('codigo_carga'),
            'bot_header_id' => $request->input('bot_header_id'),
            'date_created' => date('Y-m-d'),
            'hour_created' => date('H:m:i'),
            'user_create' => Auth::user()->id,
            'user_name' => Auth::user()->username,
        ];
        $header = MassiveHeader::create($dataHeader);
        $dataDate = [
            'company_id' => Auth::user()->company_id,
            'code_header' => $header->code,
            'massive_header_id' => $header->id,
            'date_created' => ($request->input('input_inmediato') == 'N') ? $request->input('fecha_envio') : date('Y-m-d'),
            'hour_created' => ($request->input('input_inmediato') == 'N') ? $request->input('hora_envio') : date('Y-m-d'),
        ];
        $enviar = DateSendMassive::create($dataDate);
        if ($request->input('input_repetir') == 'S') {
            foreach ($request->input('fechaAddHora') as $key => $campo_formato) {
                $fechahora = explode("/", $campo_formato);
                $dataDateRecurente = [
                    'company_id' => Auth::user()->company_id,
                    'code_header' => $header->code,
                    'massive_header_id' => $header->id,
                    'date_created' => $fechahora[0],
                    'hour_created' => $fechahora[1],
                ];
                DateSendMassive::create($dataDateRecurente);
            }
        }
        $archivo = $request->file('file');
        $import = new MasisiveMensajes($request->input('codigo_carga'));
        Excel::import($import, $archivo);
        $detalles = MassiveDetail::where('code_header', $header->code)->where('massive_header_id', $header->id)->get();
        $data = [
            'detalles' => $detalles,
            'cantidad' => $detalles->count(),
        ];
        return Response::json($data);
//        dd($detalles->count(), 'datas creada');
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

}
