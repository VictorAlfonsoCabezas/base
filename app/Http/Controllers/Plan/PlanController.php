<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Service;
use App\Models\PlanService;
use Response;

class PlanController extends Controller {

    public function index() {
        $planes = Plan::where('status', true)->get();
        return view('planes.index')
                        ->with('planes', $planes);
    }

    public function create() {
        $services = Service::where('status', true)->get();
        return view('planes/create')
                        ->with('services', $services);
    }

    public function store(Request $request) {
        $data = [
            "name" => strtoupper($request->input('plan_name')),
            "month_price" => $request->input('mensual'),
            "year_price" => $request->input('anual'),
            "color_1" => $request->input('color_1'),
            "color_2" => $request->input('color_2'),
            "color_3" => $request->input('color_3'),
            "status" => true,
        ];
        $plan = Plan::create($data);
        $services = Service::where('status', true)->get();
        foreach ($services as $key => $ser) {
            if ($request->has('check-' . $ser->id)) {
                $plan_service = [
                    "plan_id" => $plan->id,
                    "service_id" => $ser->id,
                    "name" => $ser->name,
                    "cantidad" => ($request->has('cont-' . $ser->id)) ? $request->input('cont-' . $ser->id) : 0,
                    "status" => true,
                ];
                $existe = PlanService::where('service_id', $ser->id)->where('status', true);
                if ($existe->count() == 0) {
                    PlanService::create($plan_service);
                }
            }
        }
        return redirect('planes')->with('mensaje', 'Plan creada con exito');
    }

    public function edit($id) {
        $plan = Plan::find($id);
        $data = array();
        $services = Service::where('status', true)->get();
        foreach ($services as $serv) {
            $existe = PlanService::where('plan_id', $plan->id)->where('service_id', $serv->id)->where('status', true);
            if ($existe->count() > 0) {
                $cantidad = PlanService::where('plan_id', $plan->id)->where('service_id', $serv->id)->where('status', true)->first()->cantidad;
                $data [] = [
                    'id' => $serv->id,
                    'name' => $serv->name,
                    'icon' => $serv->icon,
                    'cantidad' => $cantidad,
                    'vista' => true,
                ];
            } else {
                $data [] = [
                    'id' => $serv->id,
                    'name' => $serv->name,
                    'icon' => $serv->icon,
                    'cantidad' => '',
                    'vista' => false,
                ];
            }
        }
        return view('planes/edit')
                        ->with('plan', $plan)
                        ->with('service', $data);
    }

    public function update(Request $request, $id) {
//        dd($request->all());
        $planes = Plan::find($id);
        $planes->name = strtoupper($request->input('plan_name'));
        $planes->month_price = $request->input('mensual');
        $planes->year_price = $request->input('anual');
        $planes->color_1 = $request->input('color_1');
        $planes->color_2 = $request->input('color_2');
        $planes->color_3 = $request->input('color_3');
        $planes->save();
        $services = Service::where('status', true)->get();
        PlanService::where('plan_id', $planes->id)->delete();
        foreach ($services as $key => $ser) {
            if ($request->has('check-' . $ser->id)) {
                $plan_service = [
                    "plan_id" => $planes->id,
                    "service_id" => $ser->id,
                    "name" => $ser->name,
                    "cantidad" => ($request->has('cont-' . $ser->id)) ? $request->input('cont-' . $ser->id) : 0,
                    "status" => true,
                ];
                $existe = PlanService::where('service_id', $ser->id)->where('status', true);
                if ($existe->count() == 0) {
                    PlanService::create($plan_service);
                }
            }
        }

        return redirect("planes")->with('mensaje', 'Plan Editado Correctamente');
    }

    public function destroy($id) {
        $plan = Plan::find($id);
        $plan->status = false;
        $plan->save();
        $cantidad = Plan::where('status', true)->count();
        $data = [
            'cantidad' => $cantidad,
            'id' => $id
        ];
        return Response::json($data);
    }

}
