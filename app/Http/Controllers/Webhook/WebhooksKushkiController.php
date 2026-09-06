<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\ChatBotHeader;
use App\Models\ChatBotDetail;
use App\Models\PagosHeader;
use App\Models\PagosDetail;
use Illuminate\Http\Request;
use App\Models\TwilioCredenciales;
use App\Models\Company;
use Twilio\Rest\Client;

class WebhooksKushkiController extends Controller
{
    public static function webhookskushki(Request $request)
    {
        $existe = ChatBotHeader::where('pay_smart_link', $request->smartLink);
        if ($existe->count() > 0) {
            $chatBotHeader = ChatBotHeader::where('pay_smart_link', $request->smartLink)->first();

            $existeCabeceraPagos =  PagosHeader::where('chat_bot_header_id', $chatBotHeader->id)->where('status', true);
            if ($existeCabeceraPagos->count() > 0) {
                $cabeceraPagos =  PagosHeader::where('chat_bot_header_id', $chatBotHeader->id)->where('status', true)->first();
            } else {
                $cabeceraPagos = new PagosHeader();
                $cabeceraPagos->date_created = date('Y-m-d');
                $cabeceraPagos->company_id = $chatBotHeader->company_id;
                $cabeceraPagos->chat_bot_header_id = $chatBotHeader->id;
                $cabeceraPagos->pay_smart_link_url = $chatBotHeader->pay_smart_link_url;
                $cabeceraPagos->pay_smart_link = $chatBotHeader->pay_smart_link;
            }
            $cabeceraPagos->pay_status = $request->status;
            $cabeceraPagos->status = true;
            $cabeceraPagos->save();

            $existeDetallePagos =  PagosDetail::where('chat_bot_header_id', $chatBotHeader->id)->where('pagos_header_id', $cabeceraPagos->id)->where('kushki_id', $request->id)->where('status', true);
            if ($existeDetallePagos->count() > 0) {
                $detallePagos =  PagosDetail::where('chat_bot_header_id', $chatBotHeader->id)->where('pagos_header_id', $cabeceraPagos->id)->where('kushki_id', $request->id)->where('status', true)->first();
            } else {
                $detallePagos = new PagosDetail();
                $detallePagos->date_created = date('Y-m-d');
                $detallePagos->company_id  = $chatBotHeader->company_id;
                $detallePagos->chat_bot_header_id  =  $chatBotHeader->id;
                $detallePagos->pagos_header_id  = $cabeceraPagos->id;
            }


            $detallePagos->pay_payment_method = $request->paymentMethod;
            $detallePagos->pay_ticket_number = (isset($request->ticketNumber)) ? $request->ticketNumber : null;
            $detallePagos->pay_status = $request->status;
            $detallePagos->code_kushki = $request->code;
            $detallePagos->kushki_id = $request->id;
            $detallePagos->status = true;
            $detallePagos->save();


            $chatBotHeader->pay_payment_method = $request->paymentMethod;
            $chatBotHeader->pay_ticket_number = (isset($request->ticketNumber)) ? $request->ticketNumber : null;
            $chatBotHeader->pay_status = $request->status;
            $chatBotHeader->save();


            if ($request->status == "approvedTransaction") {
                $cuerpo = "El Pago fue correcto, puedes continuar presionando *OK*....";
                $data = [
                    'company_id' => $chatBotHeader->company_id,
                    'date_created' => date('Y-m-d'),
                    'chat_bot_header_id' =>  $chatBotHeader->id,
                    'bot_question' => $cuerpo,
                    'description' => 'Mensaje Automatico desde Webhook de Kushki',
                    'last_message' => true,
                    'bot' => true,
                    'date_format' => date('Y-m-d H:i:s'),
                    'messagenumber' => 0,
                    'status' => false,
                ];
                ChatBotDetail::create($data);
                $company = Company::find($chatBotHeader->company_id);
                if ($company->twilio_principal) {
                    $companyPrincipal = Company::where('principal', true)->where('status', true)->first();
                    $credenciales = TwilioCredenciales::where('company_id', $companyPrincipal->id)->where('status', true)->first();
                } else {
                    $credenciales = TwilioCredenciales::where('company_id', $chatBotHeader->company_id)->where('status', true)->first();
                }
                $sid    = $credenciales->sid;
                $token  = $credenciales->token;
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
            }



            return true;
        }
        return true;
    }
}
