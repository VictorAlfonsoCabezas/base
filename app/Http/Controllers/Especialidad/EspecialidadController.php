<?php

namespace App\Http\Controllers\Especialidad;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use App\Models\DoctorEspecialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public static function createUpdateEspecialidad($datos, $espe_id, $company, $medico)
    {
        foreach ($datos as $key => $detail) {
            $especialidad = Especialidad::where('company_id', $company->id)->where('code_intel', $detail['especialidad_id']);
            if ($especialidad->count() == 0) {
                $data = [
                    'company_id' => $company->id,
                    'date_created' => date('Y-m-d'),
                    'name' => $detail['especialidad_name'],
                    // 'description' => '',
                    'code_intel' => $detail['especialidad_id'],
                    'status' => true
                ];
                $existe = Especialidad::where('company_id', $company->id)->where('code_intel', $detail['especialidad_id']);
                if ($existe->count() == 0) {
                    $espe = Especialidad::create($data);
                } else {
                    $espe = Especialidad::where('company_id', $company->id)->where('code_intel', $detail['especialidad_id'])->first();
                }
            }
            $doctorEspecialidadOnly = Especialidad::where('company_id', $company->id)->where('especialidad_id', $espe->id);
            if ($doctorEspecialidadOnly->count() == 0) {
                $data = [
                    'company_id' => $company->id,
                    'date_created' => date('Y-m-d'),
                    'doctor_id' => $medico->id,
                    'especialidad_id' => $espe->id,
                    // 'description' => '',
                    'status' => true
                ];
                DoctorEspecialidad::create($data);
            }
        }
        $especialidadesDoctor = Especialidad::where('company_id', $company->id)->where('doctor_id', $medico->id)->whereIn('code_intel', $espe_id)->get();
        $espeArray = [];
        foreach ($especialidadesDoctor as $key => $espe) {
            array_push($espeArray, $espe->id);
        }
        //Borramos especialidades que ya no ecistan para el paciente
        DoctorEspecialidad::where('company_id', $company->id)->where('doctor_id', $medico->id)->whereNotIn('especialidad_id', $espeArray)->delete();
        return true;
    }
}
