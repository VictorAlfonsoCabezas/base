<?php

namespace App\Http\Controllers\ApiHeader;

use App\Http\Controllers\Controller;
use App\Models\ApiHeader;
use App\Models\ApiDetail;
use App\Models\ApiParameters;
use App\Models\BotIntention;
use App\Models\ApiIntention;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ApiHeaderController extends Controller
{
    public function index()
    {
        $company = Company::all();
        return view('apiheader/index')
            ->with('company', $company);
    }

    public function show($id)
    {
        $apis = ApiHeader::where('company_id', $id)->get();
        return Response::json($apis);
    }

    public function showParameters($header, $company_id)
    {
        $company = Company::find($company_id);
        $header = ApiHeader::find($header);
        $columns = [];
        if ($header->need_table) {
            if ($header->type_api == 1) {
                $columns = \Schema::getColumnListing($header->table_name);
            } else {
                $urlRaizCompany = $company->url;
                $url = $urlRaizCompany . '/restful/api-sigcrm/show-columns-sigcenter';
                $table = $header->table_name;
                $data = [
                    'empresa' => $company->code_intel,
                    'table' => $table,
                ];
                $json = json_encode($data);
                $options = stream_context_create([
                    'http' => [
                        'method' => $header->method,
                        'header' => 'Content-type: application/json',
                        'content' => $json
                    ]
                ]);
                $result = file_get_contents($url, false, $options);
                $columns = json_decode($result);
            }
        }
        $detail = ApiDetail::where('company_id', $company->id)->where('api_header_id', $header->id)->where('status', true)->get();
        $parameters = ApiParameters::where('company_id', $company->id)->where('api_header_id', $header->id)->where('status', true)->get();
        return Response::json([
            'header' => $header,
            'detail' => $detail,
            'parameters' => $parameters,
            'columns' => $columns,
            'sistema' => $header->type_api
        ]);
    }

    public function showIntention($header, $company_id)
    {
        $intention = BotIntention::where('status', true)->get();
        foreach ($intention as $value) {
            $checked = ApiIntention::where('company_id', $company_id)
                ->where('api_header_id', $header)
                ->where('bot_intention_id', $value->id)
                ->where('status', true);
            if ($checked->count() == 0) {
                $value->checked = 0;
            } else {
                $value->checked = 1;
            }
        }
        return Response::json($intention);
    }

    public function saveIntention(Request $request)
    {
        ApiIntention::where('company_id', $request->input('company'))
            ->where('api_header_id', $request->input('api'))
            ->where('bot_intention_id', $request->input('intention'))
            ->delete();
        if ($request->input('estado') == '1') {
            $data = [
                'date_created' => date('Y-m-d'),
                'company_id' => $request->input('company'),
                'api_header_id' => $request->input('api'),
                'bot_intention_id' => $request->input('intention'),
                'status' => true,
            ];
            ApiIntention::create($data);
        }
        return Response::json(true);
    }

    public function agregarApis($company_id, $sistema)
    {
        $company = Company::find($company_id);
        if ($sistema == 1) {
            $tables = DB::select('SHOW TABLES');
        } else {
            $url = $company->url;
            $url .= '/restful/api-sigcrm/show-table-sigcenter';
            $method = 'POST';
            $data = [
                'empresa' => $company->code_intel,
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
            $tables = json_decode($result);
        }
        return Response::json([
            'tables' => $tables,
            'company' => $company
        ]);
    }

    public function store(Request $request)
    {
        $data = [];
        $data = $request->input('parametros');
        $data['date_created'] = date('Y-m-d');
        $header = new ApiHeader($data);
        $header->save();
        $apis = ApiHeader::where('company_id', $header->company_id)->get();
        return Response::json($apis);
    }

    public function agregarCampo(Request $request)
    {
        $data = $request->input('parametros');
        $alias = (isset($data['alias'])) ? $data['alias'] : null;
        $existe = ApiDetail::where('company_id', $data['company_id'])
            ->where('api_header_id', $data['api_header_id'])
            ->where('column_name', $data['column_name'])
            ->where('alias', $alias)
            ->where('status', true);
        if ($existe->count() == 0) {
            $datos = [
                'company_id' => $data['company_id'],
                'date_created' => date('Y-m-d'),
                'api_header_id' => $data['api_header_id'],
                'column_name' => $data['column_name'],
                'alias' => $alias
            ];
            ApiDetail::create($datos);
        }
        $detail = ApiDetail::where('company_id', $data['company_id'])
            ->where('api_header_id', $data['api_header_id'])
            ->where('status', true)->get();
        return Response::json($detail);
    }

    public function agregarParameters(Request $request)
    {
        $data = $request->input('parametros');
        $existe = ApiParameters::where('company_id', $data['company_id'])
            ->where('api_header_id', $data['api_header_id'])
            ->where('name', $data['name'])
            ->where('status', true);
        if ($existe->count() == 0) {
            $datos = [
                'company_id' => $data['company_id'],
                'date_created' => date('Y-m-d'),
                'api_header_id' => $data['api_header_id'],
                'name' => $data['name']
            ];
            ApiParameters::create($datos);
        }
        $parameters = ApiParameters::where('company_id', $data['company_id'])
            ->where('api_header_id', $data['api_header_id'])
            ->where('status', true)->get();
        return Response::json($parameters);
    }

    public function deleteCol($id)
    {
        $detalle = ApiDetail::find($id);
        $company = $detalle->company_id;
        $header = $detalle->api_header_id;
        $detalle->delete();
        $detail_new = ApiDetail::where('company_id', $company)
            ->where('api_header_id', $header)
            ->where('status', true)->get();
        return Response::json($detail_new);
    }

    public function deleteParam($id)
    {
        $parameters = ApiParameters::find($id);
        $company = $parameters->company_id;
        $header = $parameters->api_header_id;
        $parameters->delete();
        $parameters_new = ApiParameters::where('company_id', $company)
            ->where('api_header_id', $header)
            ->where('status', true)->get();
        return Response::json($parameters_new);
    }

    public function deleteApi($id)
    {
        $apis = ApiHeader::find($id);
        $company = $apis->company_id;
        ApiDetail::where('api_header_id', $id)->delete();
        ApiParameters::where('api_header_id', $id)->delete();
        $apis->delete();
        $apis_new = ApiHeader::where('company_id', $company)->get();
        $detail = ApiDetail::where('company_id', $company)->where('api_header_id', $id)->where('status', true)->get();
        $parameters = ApiParameters::where('company_id', $company)->where('api_header_id', $id)->get();
        return Response::json([
            'detail' => $detail,
            'parameters' => $parameters,
            'apis_new' => $apis_new
        ]);
    }

    public function showApi($id)
    {
        $ApiHeader = ApiHeader::find($id);
        return Response::json($ApiHeader);
    }

    public function updateApi(Request $request, $id)
    {
        $data = [];
        $data = $request->input('parametros');
        $data['date_created'] = date('Y-m-d');
        ApiHeader::find($id)->update($data);
        $apis = ApiHeader::where('company_id', $data['company_id'])->get();
        return Response::json($apis);
    }
}
