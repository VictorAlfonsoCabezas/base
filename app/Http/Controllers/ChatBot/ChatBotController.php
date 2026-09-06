<?php

namespace App\Http\Controllers\ChatBot;

use App\Http\Controllers\Controller;
use App\Models\ChatBotDetail;
use App\Models\Customer;
use App\Models\ChatBotHeader;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ChatBotController extends Controller
{
    public function index()
    {
        $chatActivos = ChatBotHeader::where('status', true)->get();
        foreach ($chatActivos as $key => $valueActivos) {
            $ultimoMensaje =ChatBotDetail::where('chat_bot_header_id', $valueActivos->id)
                ->where('status', true)
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->first();
            $valueActivos->ultimoMensaje = ($ultimoMensaje->bot_question !== null) ? 'Tú: ' . $ultimoMensaje->bot_question : $ultimoMensaje->customer_answer;
        }
        
        $chatFinalizados = ChatBotHeader::where('status', false)->get();
        foreach ($chatFinalizados as $key => $valueFin) {
            $ultimoMensaje =ChatBotDetail::where('chat_bot_header_id', $valueFin->id)
                ->where('status', true)
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->first();
            $valueFin->ultimoMensaje = ($ultimoMensaje->bot_question !== null) ? 'Tú: ' . $ultimoMensaje->bot_question : $ultimoMensaje->customer_answer;
        }
        return view('chatbot/index')
            ->with('chatActivos', $chatActivos)
            ->with('chatFinalizados', $chatFinalizados);
    }

    public function edit($id)
    {
        $header = ChatBotHeader::find($id);
        $customer = Customer::find($header->customer_id);
        $address = CustomerAddress::where('customer_id', $customer->id)
            ->where('status', true);
        $address = $address->get();
        $data = [
            'header' => $header,
            'customer' => $customer,
            'address' => $address
        ];
        return Response::json($data);
    }

    public function showConversation($id)
    {
        $conversation = ChatBotDetail::where('chat_bot_header_id', $id)->get();
        return Response::json($conversation);
    }

    public function showMapa($id)
    {
        $customer = Customer::find($id);
        return Response::json($customer);
    }
}
