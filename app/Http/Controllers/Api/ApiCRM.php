<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\ApiHeader;
use App\Models\ApiDetail;
use App\Models\ApiParameters;
use App\Models\BotDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ChatBotDetail;
use App\Models\BotHistorial;
use App\Models\BotCustomerResponse;
use App\Models\Company;
use App\Models\Region;
use Response;

class ApiCRM extends Controller
{
    //**** MOSTRAR CONSULTA DE UNA API ****//
    public function showApiMaster(Request $request)
    {
        try {
            $header = ApiHeader::find($request->input('api_header_id'));
            $company = Company::find($header->company_id);
            $TABLE = $header->table_name;
            $detail = ApiDetail::where('company_id', $header->company_id)
                ->where('api_header_id', $request->input('api_header_id'))
                ->get();

            $campos = '';
            foreach ($detail as $key => $value) {
                if ($key == 0) {
                    $campos .= $value->column_name;
                } else {
                    $campos .= ' ,' . $value->column_name;
                }
            }

            $parameters = ApiParameters::where('company_id', $header->company_id)
                ->where('api_header_id', $request->input('api_header_id'))
                ->get();

            $param = '';
            $customer = false;
            $company = false;
            foreach ($parameters as $key => $value) {
                if ($value->name == 'customer_id') {
                    $customer = true;
                    if ($param == '') {
                        $param .= $value->name . '=' . $request->input('customer_id');
                    } else {
                        $param .= ' AND ' . $value->name . '=' . $request->input('customer_id');
                    }
                } else if ($value->name == 'company_id') {
                    $company = true;
                    if ($param == '') {
                        $param .= $value->name . '=' . $request->input('company_id');
                    } else {
                        $param .= ' AND ' . $value->name . '=' . $request->input('company_id');
                    }
                }else{
                    $existe = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))->where('campo_name', $value->name)->where('status', true);
                    if($existe->count()){
                        $customerResponse = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))->where('campo_name', $value->name)->where('status', true)->first();
                        if ($param == '') {
                            $param .= $value->name . '=' . "'" . $customerResponse->response_customer . "'";
                        } else {
                            $param .= ' AND ' . $value->name . '=' . "'" . $customerResponse->response_customer . "'";
                        }
                    }
                }
            }

            $status = 'status = 1';
            if ($param == '') {
                $param .= $status;
            } else {
                $param .= ' AND ' . $status;
            }
            $sql = "SELECT $campos FROM $TABLE WHERE $param";
            $respuestaSQL = DB::select($sql);
            return json_encode(array(
                'status' => 200,
                'data' => $respuestaSQL,
                'response' => array(
                    'msg' => 'Information is showed correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    //**** ACTUALIZA UN REGISTRO BAJO PARAMETROS QUE SE ENVÍE Y DATOS QUE SE ENVÍE ****//
    public function showApiMasterRefresh(Request $request)
    {
        try {
            $request->input('bot_detail_id');
            $BotDetail = BotDetail::find($request->input('bot_detail_id'));
            $update = '';
            $parameters = '';
            if ($BotDetail->intention->code == 'RE') {
                $botHistorial = BotHistorial::where('bot_header_id', $BotDetail->bot_header_id)
                    ->where('bot_detail_id', $BotDetail->id)
                    ->first();
                $header = ApiHeader::find($botHistorial->api_header_id);

                $TABLE = $header->table_name;
                $customerCompany = ApiParameters::where('api_header_id', $header->id)->get();
                foreach ($customerCompany as $key => $val) {
                    $customerResponse = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))->where('table_name', $TABLE)->where('campo_name', $val->name)->first();
                    if ($parameters == '') {
                        $parameters .= $val->name . '=' . "'" . $customerResponse->response_customer . "'";
                    } else {
                        $parameters .= ' AND ' . $val->name . '=' . "'" . $customerResponse->response_customer . "'";
                    }
                    $customerParametros = [
                        'chat_bot_header_id' => $request->input('chat_bot_header_id'),
                        'date_created' => date('Y-m-d'),
                        'table_name' => $TABLE,
                        'campo_name' => $val->name,
                        'response_customer' => $customerResponse->response_customer,
                        'status' => true,
                    ];
                    $existe = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))
                        ->where('table_name', $TABLE)
                        ->where('campo_name', $val->name)
                        ->where('response_customer', $customerResponse->response_customer);
                    if ($existe->count() == 0) {
                        BotCustomerResponse::create($customerParametros);
                    }
                }
                if ($botHistorial->api_header_id !== NULL && $botHistorial->api_header_id !== '') {
                    $detail = ApiDetail::where('api_header_id', $botHistorial->api_header_id);
                    foreach ($detail->get() as $value) {
                        if ($update == '') {
                            $update .= $value->column_name . '=' . "'" . $request->input('dato_actualizar') . "'";
                        } else {
                            $update .= ', ' . $value->column_name . '=' . "'" . $request->input('dato_actualizar') . "'";
                        }
                    }
                }
            }
            $status = 1;
            if ($parameters == '') {
                $parameters .= 'status=' . "'" . $status . "'";
            } else {
                $parameters .= ' AND status =' . "'" . $status . "'";
            }

            $sql = "UPDATE $TABLE SET $update WHERE $parameters";
            $region = [
                'name' => 'entraaa sql: ' . $sql
            ];
            Region::create($region);
            $respuestaSQL = DB::select($sql);
            return json_encode(array(
                'status' => 200,
                'data' => $respuestaSQL,
                'response' => array(
                    'msg' => 'Information is showed correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            $region = [
                'name' => 'ERROR: ' . $e
            ];
            Region::create($region);
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    public function showApiMasterCreate(Request $request)
    {
        try {
            $request->input('bot_detail_id');
            $BotDetail = BotDetail::find($request->input('bot_detail_id'));
            $update = '';
            $parameters = '';
            if ($BotDetail->intention->code == 'RE') {

                $botHistorial = BotHistorial::where('bot_header_id', $BotDetail->bot_header_id)
                    ->where('bot_detail_id', $BotDetail->id)
                    ->first();
                    
                $header = ApiHeader::find($botHistorial->api_header_id);

                $TABLE = $header->table_name;
                $customerCompany = ApiParameters::where('api_header_id', $header->id)->get();
                foreach ($customerCompany as $key => $val) {
                    $customerResponse = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))->where('table_name', $TABLE)->where('campo_name', $val->name)->first();
                    if ($parameters == '') {
                        $parameters .= $val->name . '=' . "'" . $customerResponse->response_customer . "'";
                    } else {
                        $parameters .= ' AND ' . $val->name . '=' . "'" . $customerResponse->response_customer . "'";
                    }
                    $customerParametros = [
                        'chat_bot_header_id' => $request->input('chat_bot_header_id'),
                        'date_created' => date('Y-m-d'),
                        'table_name' => $TABLE,
                        'campo_name' => $val->name,
                        'response_customer' => $customerResponse->response_customer,
                        'status' => true,
                    ];
                    $existe = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))
                        ->where('table_name', $TABLE)
                        ->where('campo_name', $val->name)
                        ->where('response_customer', $customerResponse->response_customer);
                    if ($existe->count() == 0) {
                        BotCustomerResponse::create($customerParametros);
                    }
                }
                if ($botHistorial->api_header_id !== NULL && $botHistorial->api_header_id !== '') {
                    $detail = ApiDetail::where('api_header_id', $botHistorial->api_header_id);
                    foreach ($detail->get() as $value) {
                        if ($update == '') {
                            $update .= $value->column_name . '=' . "'" . $request->input('dato_actualizar') . "'";
                        } else {
                            $update .= ', ' . $value->column_name . '=' . "'" . $request->input('dato_actualizar') . "'";
                        }
                    }
                }
            }
            $status = 1;
            if ($parameters == '') {
                $parameters .= 'status=' . "'" . $status . "'";
            } else {
                $parameters .= ' AND status =' . "'" . $status . "'";
            }

            $sql = "UPDATE $TABLE SET $update WHERE $parameters";
            $region = [
                'name' => 'entraaa sql: ' . $sql
            ];
            Region::create($region);
            $respuestaSQL = DB::select($sql);
            return json_encode(array(
                'status' => 200,
                'data' => $respuestaSQL,
                'response' => array(
                    'msg' => 'Information is showed correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            $region = [
                'name' => 'ERROR: ' . $e
            ];
            Region::create($region);
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    //**** ACTUALIZA LA LATITUD Y LONGITUD DE UNA DE LAS DIRECCIONES DEL CLIENTE ****//
    public function showApiMasterRefreshLocation(Request $request)
    {
        try {
            $header = ApiHeader::find($request->input('api_header_id'));
            $TABLE = $header->table_name;
            $datos = [
                'latitud' => strtoupper($request->input('latitud')),
                'longitud' => strtoupper($request->input('longitud')),
            ];
            $parameters = ApiParameters::where('company_id', $header->company_id)
                ->where('api_header_id', $request->input('api_header_id'))
                ->get();

            foreach ($parameters as $key => $value) {
                $customerResponse = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))->where('campo_name', $value->name)->first();
                $datos[$customerResponse->campo_name] = $customerResponse->response_customer;
            }

            // $respuestaSQL = DB::connection()->table($TABLE)->insert($datos);
            $id = DB::table('customer_address')->insertGetId($datos);

            $customerParametros = [
                'chat_bot_header_id' => $request->input('chat_bot_header_id'),
                'date_created' => date('Y-m-d'),
                'table_name' => $TABLE,
                'campo_name' => 'id',
                'response_customer' => $id,
                'status' => true,
            ];
            $existe = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))
                ->where('table_name', $TABLE)
                ->where('campo_name', 'id')
                ->where('response_customer', $id);
            if ($existe->count() == 0) {
                BotCustomerResponse::create($customerParametros);
            }

            $customerParametros2 = [
                'chat_bot_header_id' => $request->input('chat_bot_header_id'),
                'date_created' => date('Y-m-d'),
                'table_name' => $TABLE,
                'campo_name' => $TABLE . '_id',
                'response_customer' => $id,
                'status' => true,
            ];
            $existe2 = BotCustomerResponse::where('chat_bot_header_id', $request->input('chat_bot_header_id'))
                ->where('table_name', $TABLE)
                ->where('campo_name', $TABLE . '_id')
                ->where('response_customer', $id);
            if ($existe2->count() == 0) {
                BotCustomerResponse::create($customerParametros2);
            }


            return json_encode(array(
                'status' => 200,
                'data' => $id,
                'response' => array(
                    'msg' => 'Information is showed correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }

    public function saveApiInformation(Request $request)
    {
        try {
            $chat = ChatBotDetail::where('chat_bot_header_id', $request->input('chat_bot_header_id'))
                ->where('bot', false)
                ->get();
            $j = 0;
            foreach ($chat as $key => $value) {
                if (isset($value->botDetail)) {
                    if ($value->botDetail->guardado) {
                        $botHistorial = BotHistorial::where('bot_header_id', $value->botDetail->bot_header_id)
                            ->where('bot_detail_id', $value->botDetail->id)
                            ->first();
                        if ($j == 0) {
                            $header = ApiHeader::find($botHistorial->api_header_id);
                            $j++;
                        }
                        $data = [];
                        if ($botHistorial->api_parameters_id !== NULL && $botHistorial->api_parameters_id !== '') {
                            $param = ApiParameters::find($botHistorial->api_parameters_id);
                            $data[$param->name] = $value->customer_answer;
                        }
                    }
                }
            }

            $TABLE = $header->table_name;
            if ($header->type_api == 1) {
                $respuestaSQL = DB::table($TABLE)->insert($data);
            } else {
                //aqui debemos determinar la empresa
                $url = 'http://hsanbartolo.ddns.net:8085/restful/api-sigcrm/insert-data-sigcrm';
                $data['empresa'] = 100;
                $data['table'] = $TABLE;
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
            }
            return json_encode(array(
                'status' => 200,
                'data' => $respuestaSQL,
                'response' => array(
                    'msg' => 'Information is saved correctly...'
                )
            ));
        } catch (\Exception $exc) {
            $e = $exc->getMessage() . ' - ' . $exc->getFile() . ' || ' . $exc->getLine() . ' |||| ';
            return json_encode(array(
                'status' => 400,
                'response' => array(
                    'msg' => $e
                )
            ));
        }
    }
}
