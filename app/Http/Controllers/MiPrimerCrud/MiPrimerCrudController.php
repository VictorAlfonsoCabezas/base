<?php

namespace App\Http\Controllers\MiPrimerCrud;

use App\Http\Controllers\Controller;
use App\Models\MspCookies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MiPrimerCrudController extends Controller
{
    public static function consultaDatosCliente($cedula, $tipoDocumento)
    {
        //CONSTANTES
        $pacienteNombre = [];

        //10 digitos
        if (strlen($cedula) !== 10) {
            $data = [
                'code' => 400,
                'msg' => 'Documento inválido',
            ];
            return $data;
        }

        //Tipo 6 cédula
        if ($tipoDocumento !== 6) {
            $data = [
                'code' => 401,
                'msg' => 'Tipo de documento invalido',
            ];
            return $data;
        }


        
        
        $fechaHoraActual = date('Y-m-d H:i:s');
        // $fechaHoraActual = "2022-08-24 19:15:59";
        // $fechaHoraActual = "2022-08-24 19:15:59";
        // $fechaHoraActual = "2022-08-24 19:15:59";
        $session = MspCookies::where('date_expired', '>', $fechaHoraActual)->first();
        if(is_null($session)){
            //borrar todas las claves
            DB::table('msp_cookies')->delete();
            // LOGIN //
            $usuario = '1715339550';
            $clave = '1715339550';
            $ch = curl_init('https://sgrdacaa-admision.msp.gob.ec/login_check?usuario=' . $usuario . '&clave=' . $clave);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            $result = curl_exec($ch);
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);        // get cookie
            $cookies = array();
            foreach ($matches[1] as $item) {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
            $PHPSESSID = $cookies['PHPSESSID'];
            $NCS = $cookies['NSC_wjsu_tfsw_benjtjpoqsbt_qspe'];
            $NuevaFecha = strtotime ( '+10 hour' , strtotime ($fechaHoraActual)) ; 
            $NuevaFecha = date ('Y-m-d H:i:s' , $NuevaFecha); 
            $sessionNew = New MspCookies();
            $sessionNew->date_created = date('Y-m-d');
            $sessionNew->sesion = $PHPSESSID;
            $sessionNew->cookie = $NCS;
            $sessionNew->date_expired = $NuevaFecha;
            $sessionNew->save();
            curl_close($ch);
        }else{
            $PHPSESSID = $session->sesion;
            $NCS = $session->cookie;
        }

        // $PHPSESSID = 'g7ec452gcqtef2ev8pjjolhnco';
        // $NCS = 'ffffffff09487a0545525d5f4f58455e445a4a423660';
        // $NCS2 = '123';
        
        //********  API MSP  ********//
        $curl = curl_init();
        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://sgrdacaa-admision.msp.gob.ec/hcue/paciente/paciente/busquedapaciente?cttipoidentificacion=6&numeroidentificacion=' . $cedula .'&as_sfid='.$NCS.'&as_fid='.$PHPSESSID,
            CURLOPT_URL => 'https://sgrdacaa-admision.msp.gob.ec/hcue/paciente/paciente/busquedapaciente?cttipoidentificacion=6&numeroidentificacion=' . $cedula,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: multipart/form-data',
                'Authorization: Basic ',
                "Cookie: NSC_wjsu_tfsw_benjtjpoqsbt_qspe=$NCS; PHPSESSID=$PHPSESSID",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //****    FIN API MSP    ****//

        $minimoCaracteresDatos = (int) 1100;
        $noHayResultados = (int) 200;
        if (strlen($response) <= $noHayResultados) {
            $data = [
                'code' => 203,
                'msg' => 'No existen datos para ese documento',
            ];
            return $data;
        }

        if (strlen($response) >= $minimoCaracteresDatos) {
            $data = [
                'code' => 400,
                'msg' => 'Error en las credenciales',
            ];
            return $data;
        }

        preg_match("|<tbody>(.*)</tbody>|sU", $response, $EXT);
        if (!isset($EXT[0])) {
            $data = [
                'code' => 404,
                'msg' => 'Datos mal formados',
            ];
            return $data;
        }
        $tbody = $EXT[0];
        $posicion_funcion = (int) (strrpos($tbody, 'loadDataPaciente'));
        
        $i = 50;
        $inicio = substr($tbody, $posicion_funcion + 16, $i);
        $posicion_parentesis = strrpos($inicio, ')');
        $fin = substr($tbody, $posicion_funcion + 16, $posicion_parentesis + 1);
        $idMSP = str_replace('(', "", $fin);
        $idMSP = str_replace(')', "", $idMSP);
        $idMSP = trim($idMSP);
        $etiqueta = "<td>";
        $pos = strpos($tbody, $etiqueta);
        if(!$pos){
            $data = [
                'code' => 500,
                'msg' => 'No existe ID del MSP',
            ];
            return $data;
        }
        $td = substr($tbody, $pos, -147);
        $tdNew = str_replace('<td>', "", $td);
        $tdNew = str_replace('</td>', ",", $tdNew);
        $datosUsuario = explode(",", $tdNew);
        $arrayNombre = explode(" ", trim($datosUsuario[0]), 3);
        $apellidos = trim($arrayNombre[0] . ' ' . $arrayNombre[1]);
        $nombres = trim($arrayNombre[2]);
        $cedula = trim($datosUsuario[2]);
        $fechaNacimiento = trim($datosUsuario[4]);
        $pacienteNombre['APELLIDOS'] = $apellidos;
        $pacienteNombre['NOMBRE'] = $nombres;
        $pacienteNombre['FECHA_NAC'] = $fechaNacimiento;
        //direccion telefono
        //********  API MSP  ********//
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sgrdacaa-admision.msp.gob.ec/hcue/paciente/paciente/llenar/' . $idMSP,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: multipart/form-data',
                'Authorization: Basic ',
                "Cookie: NSC_wjsu_tfsw_benjtjpoqsbt_qspe=$NCS; PHPSESSID=$PHPSESSID",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $datosIdMSP = json_decode($response);
        if (!isset($datosIdMSP->numeroidentificacion)) {
            $data = [
                'code' => 505,
                'msg' => 'No existe respuesta al ID del MSP',
            ];
            return $data;
        }
        $sexo = ($datosIdMSP->sexo == "Mujer") ? "F" : (($datosIdMSP->sexo == "Hombre") ? "M" : "");
        $estadoCivil = ($datosIdMSP->estadocivil == 'Soltero') ? 1 : (($datosIdMSP->estadocivil == 'Casado') ? 2 : 3);
        $celular = str_replace("-", "", $datosIdMSP->celular);
        $pacienteNombre['sexo'] = $sexo;
        $pacienteNombre['telefono'] = $datosIdMSP->telefono;
        $pacienteNombre['celular'] = $celular;
        $pacienteNombre['residencia'] = $datosIdMSP->residencia;
        $pacienteNombre['direccion'] = $datosIdMSP->direccion;
        $pacienteNombre['nacionalidad'] = $datosIdMSP->nacionalidad;
        $pacienteNombre['lugarnacimiento'] = $datosIdMSP->lugarnacimiento;
        $pacienteNombre['estadocivil'] = $estadoCivil;
        $data = [
            'code' => 200,
            'msg' => 'Consulta exitosa',
            'data' => $pacienteNombre
        ];
        return $data;
    }
}
