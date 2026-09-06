<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Auth;
use Response;

class DoctorController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $doctor = Doctor::where('status', true)->get();
        } else {
            $doctor = Doctor::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('doctor/index')
            ->with('doctor', $doctor);
    }
    public static function createUpdateDoctor($datos, $company)
    {
        $doctor = Doctor::where('company_id', $company->id)->where('code_intel', $datos['medico_id']);
        if ($doctor->count() > 0) {
            $doctor = Doctor::where('company_id', $company->id)->where('code_intel', $datos['medico_id'])->first();
            $doctor->name = $datos['medico_name'];
            $doctor->code_intel = $datos['medico_id'];
            $doctor->status = true;
            $doctor->save();
        } else {
            $data = [
                'company_id' => $company->id,
                'date_created' => date('Y-m-d'),
                'name' => $datos['medico_name'],
                'code_intel' => $datos['medico_id'],
                'status' => true,
            ];
            $doctor = Doctor::create($data);
        }
        return $doctor;
    }

    public function show($id)
    {
        $schedule = DoctorSchedule::where('doctor_id', $id)->where('status', true)->get();
        $dias = array('LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO');
        foreach ($schedule as $key => $value) {
            $value->day_name = $dias[$value->day];
        }
        return Response::json($schedule);
    }
}
