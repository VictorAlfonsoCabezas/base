<?php

namespace App\Http\Controllers\Pagos;

use App\Http\Controllers\Controller;
use App\Models\ChatBotHeader;
use Illuminate\Http\Request;
use App\Models\PagosHeader;
use App\Models\PagosDetail;
use Response;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = PagosHeader::all();
        foreach ($pagos as $key => $value) {
            $chatCabecera = ChatBotHeader::find($value->chat_bot_header_id);
            $value->nombreCliente =  $chatCabecera->customer->nombres . ' ' . $chatCabecera->customer->apellidos;
        }
        return view('pagos/index')
            ->with('pagos', $pagos);
    }



    public function edit($id)
    {   
        $detalle = PagosDetail::where('pagos_header_id', $id)->get();
        return Response::json($detalle);
    }

}
