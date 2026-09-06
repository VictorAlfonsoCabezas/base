<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\CategoryMessage;
use App\Models\ChatBotDetail;
use App\Models\ChatBotHeader;
use App\Models\ChatHeaderCategoryMessage;
use App\Models\TwilioCredenciales;
use App\Models\Company;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{

    public function index()
    {
        $category = CategoryMessage::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        return view('agent/index')
            ->with('category', $category);
    }

    public function cargarTabla(Request $request)
    {
        $categorias = $request->input('categorias');
        if (is_null($request->input('estado'))) {
            $estado = 1;
        } else {
            $estado = (int) $request->input('estado');
        }


        $estadoGeneral = $request->input('estadoGeneral');
        if (is_null($request->input('estadoGeneral'))) {
            $usuario = Auth::user()->id;
        } else {
            if ($estadoGeneral == 'PENDIENTE') {
                $usuario = null;
            } else {
                $usuario = Auth::user()->id;
            }
        }

        // dd($categorias);

        $chatActivos = DB::table('chat_bot_header')
            ->select('chat_bot_header.id', 'chat_bot_header.status', 'chat_bot_header.updated_at', 'chat_bot_header.status_venta', 'customer.nombres', 'customer.apellidos')
            ->leftjoin('chat_header_category_message', 'chat_bot_header.id', '=', 'chat_header_category_message.chat_bot_header_id')
            ->join('customer', 'chat_bot_header.customer_id', '=', 'customer.id')
            ->leftjoin('users', 'chat_bot_header.user_assigned_id', '=', 'users.id')
            ->where('chat_bot_header.user_assigned_id', $usuario)
            ->where('chat_bot_header.company_id', Auth::user()->company_id)
            ->where('chat_bot_header.agente', 1)
            ->when($categorias, function ($query, $categorias) {
                $query->whereIn('chat_header_category_message.category_message_id', [$categorias]);
            })
            ->when($estadoGeneral, function ($query, $estadoGeneral) {
                $query->where('chat_bot_header.status_venta', $estadoGeneral);
            })
            ->when($usuario, function ($query, $usuario) {
                $query->where('chat_bot_header.user_assigned_id', $usuario);
            })
            ->where('chat_bot_header.status', $estado)
            ->orderBy('chat_bot_header.updated_at', 'DESC')
            ->groupBy('chat_bot_header.id')
            ->get();


        foreach ($chatActivos as $key => $valueActivos) {
            $ultimoMensaje = ChatBotDetail::where('chat_bot_header_id', $valueActivos->id)
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->first();
            if (!is_null($ultimoMensaje)) {
                $UltimoMensajeEnviado = ($ultimoMensaje->bot_question !== null) ? 'Tú: ' . $ultimoMensaje->bot_question : $ultimoMensaje->customer_answer;
                $valueActivos->ultimoMensaje = ($UltimoMensajeEnviado !== null) ? $UltimoMensajeEnviado : '....';
            } else {
                $valueActivos->ultimoMensaje = '...';
            }
        }
        return Response::json($chatActivos);
    }

    public function showConversation($id)
    {
        $header = ChatBotHeader::find($id);
        $conversation = ChatBotDetail::where('chat_bot_header_id', $id)
            ->orderBy('id', 'ASC')
            ->get();
        foreach ($conversation as $key => $value) {
            $value->horaFormato = date("g:i A", strtotime($value->created_at));
            $value->fechaActual = date("Y-m-d");
        }

        $category = CategoryMessage::where('company_id', Auth::user()->company_id)->get();
        foreach ($category as $key => $value) {
            $relacion = ChatHeaderCategoryMessage::where('company_id', Auth::user()->company_id)
                ->where('category_message_id', $value->id)
                ->where('chat_bot_header_id', $id)
                ->get();

            if ($relacion->count()) {
                $value->statusChecked = true;
            } else {
                $value->statusChecked = false;
            }
        }

        $data = [
            'category' => $category,
            'customer' => $header->customer,
            'conversation' => $conversation,
            'header' => $header
        ];
        return Response::json($data);
    }

    public function sendWhatsappAgente(Request $request)
    {
        $chatBotHeader = ChatBotHeader::find($request->input('id'));
        $chatBotHeader->agente = true;
        $chatBotHeader->save();

        $cuerpo = $request->input('text');
        $data = [
            'company_id' => $chatBotHeader->company_id,
            'date_created' => date('Y-m-d'),
            'chat_bot_header_id' => $chatBotHeader->id,
            'bot_question' => $cuerpo,
            'description' => 'Mensaje Envia Agente',
            'last_message' => true,
            'bot' => true,
            'date_format' => date('Y-m-d H:i:s'),
            'messagenumber' => 0,
            'user_write_id' => Auth::user()->id,
            'status' => true,
        ];
        ChatBotDetail::create($data);
        $company = Company::find($chatBotHeader->company_id);
        if ($company->twilio_principal) {
            $companyPrincipal = Company::where('principal', true)->where('status', true)->first();
            $credenciales = TwilioCredenciales::where('company_id', $companyPrincipal->id)->where('status', true)->first();
        } else {
            $credenciales = TwilioCredenciales::where('company_id', $chatBotHeader->company_id)->where('status', true)->first();
        }
        $sid = $credenciales->sid;
        $token = $credenciales->token;
        $number = $credenciales->phone_number;
        $twilio = new Client($sid, $token);
        $receptor = $chatBotHeader->customer->celular_1;
        $message = $twilio->messages
            ->create(
                "whatsapp:+" . $receptor, // to 
                array(
                    "from" => "whatsapp:+" . $number,
                    "body" => $cuerpo
                )
            );
        return Response::json(true);
    }

    public function updateConfig(Request $request)
    {
        $id = $request->input('header');
        $tipo = $request->input('tipo');
        $resultado = $request->input('resultado');
        $header = ChatBotHeader::find($id);
        if ($tipo == 'bot') {
            $header->agente = $resultado;
        }
        if ($tipo == 'cierre') {
            $header->status = $resultado;
        }
        if ($tipo == 'hand') {
            $header->status_venta = $resultado;
        }
        $header->save();
        return Response::json(true);
    }

    public function countMenssage($id)
    {
        $cantidad = ChatBotDetail::where('chat_bot_header_id', $id)->get()->count();
        return Response::json($cantidad);
    }

    public function updateCategory(Request $request, $id)
    {
        ChatHeaderCategoryMessage::where('chat_bot_header_id', $id)->delete();
        foreach ($request->input('category') as $key => $value) {
            $new = new ChatHeaderCategoryMessage();
            $new->company_id = Auth::user()->company_id;
            $new->date_created = date('Y-m-d');
            $new->category_message_id = $value;
            $new->chat_bot_header_id = $id;
            $new->save();
        }
        return Response::json(true);
    }

    public function aceptarPedido(Request $request, $id)
    {
        $header = ChatBotHeader::find($id);
        $header->user_assigned_id = Auth::user()->id;
        $header->status_venta = 'ACEPTADO';
        $header->save();
        $nombres = strtolower(Auth::user()->firstname);
        $apellidos = strtolower(Auth::user()->lastname);
        $action = ucfirst($nombres) . ' ' . ucfirst($apellidos) . ' <b>aceptó</b> el chat.';
        $data = [
            'company_id' => Auth::user()->company_id,
            'date_created' => date('Y-m-d'),
            'chat_bot_header_id' => $header->id,
            // 'bot_question' => '',
            'description' => $action,
            'last_message' => true,
            'bot' => true,
            'action' => true,
            'date_format' => date('Y-m-d H:i:s'),
            'messagenumber' => 0,
            'status' => true,
        ];
        ChatBotDetail::create($data);
        return Response::json(true);
    }
}
