<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\MassiveHeader;
use App\Models\MassiveDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class MasisiveMensajes implements ToModel, WithHeadingRow {

    private $code;

    public function __construct($code) {
        $this->code = $code;
    }

    public function model(array $row) {
        $header = MassiveHeader::where('code', $this->code)->first();
        $existe = MassiveDetail::where('code_header', $this->code)->where('massive_header_id', $header->id)->where('citizenship_card', $row['n_identificacion'])->where('status', true);
        $caracteres = strlen($row['n_identificacion']);
        if ($caracteres == 13) {
            $codigoDocumento = 'RUC';
        } elseif ($caracteres == 10) {
            $codigoDocumento = 'CI';
        } else {
            $codigoDocumento = 'PA';
        }
        if ($existe->count() == 0) {
            $data = [
                'company_id' => Auth::user()->company_id,
                'code_header' => $this->code,
                'massive_header_id' => $header->id,
                'first_name' => (isset($row['n_identificacion'])) ? mb_strtoupper($row['n_identificacion']) : null,
                'second_name' => (isset($row['n_identificacion'])) ? mb_strtoupper($row['n_identificacion']) : null,
                'last_name' => (isset($row['n_identificacion'])) ? mb_strtoupper($row['n_identificacion']) : null,
                'surname' => (isset($row['n_identificacion'])) ? mb_strtoupper($row['n_identificacion']) : null,
                'citizenship_type' => $codigoDocumento,
                'citizenship_card' => $row['n_identificacion'],
                'phone' => $row['n_identificacion'],
                'cellular' => $row['celular'],
                'email' => $row['correo'],
                'envios' => 0,
            ];
            MassiveDetail::create($data);
        }
    }

}

//class MasisiveMensajes implements ToCollection {
//
//    private $code;
//
//    public function __construct($code) {
//        $this->code = $code;
//    }
//
//    public function collection(Collection $rows) {
//        dd($this->code, 'dtata',$rows);
////        $cont = 0;
////        foreach ($rows as $row) {
////            if ($cont > 0) {
////                $data[] = [
////                    'nombre' => $row[0]
////                ];
////            }
////
////            $cont++;
////        }
////        return $data;
////        dd($data);
//    }
//
//}

//class MasisiveMensajes implements ToCollection {
//
//    public function collection(Collection $rows) {
//        $cont = 0;
//        foreach ($rows as $row) {
//            if ($cont > 0) {
//                $data[] = [
//                    'nombre' => $row[0]
//                ];
//            }
//
//            $cont++;
//        }
//        return $data;
//        dd($data);
//    }
//
//}

//class MasisiveMensajes implements ToModel, WithHeadingRow {
//
//    public function model(array $rows) {
////        dd($rows);
//        foreach ($rows as $row) {
//            dd($row);
//            $data[] = [
//            'promerNombre' => $row['primer_nombre'],
//            ];
//        }
//        dd($data);
////        return new CreditFolderDetail([
////            'numero_cuota' => $row['numero_cuota'],
////            'company_id' => 1,
////            'code_folder_header' => $row['carpeta'],
////            'user_pay_id' => 0,
////            'date_vencimiento' => $row['fecha_pago'],
////            'interes_periodo' => $row['interes_periodo'],
////            'interes_mora' => 0,
////            'capital_amortizado' => $row['capital_amortizado'],
////            'fondo_desgravamen' => $row['fondo_desgravamen'],
////            'valor_cuota' => $row['valor_cuota'],
////            'saldo_remanente' => $row['saldo_remanente'],
////            'tipo_pago' => $row['tipo_pago'],
////            'status' => $row['status'],
////        ]);
//    }
//
//}

//class MasisiveMensajes implements ToModel, WithHeadingRow {
//
//    public function model(array $row) {
//       $data []=[
//           
//       ];
//       echo($row['primer_nombre']);
//    }
//
//}
