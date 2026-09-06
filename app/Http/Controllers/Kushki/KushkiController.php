<?php

namespace App\Http\Controllers\Kushki;

use App\Http\Controllers\Controller;
use App\Models\BotCustomerResponse;
use App\Models\ChatBotHeader;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class KushkiController extends Controller
{
    //******  FUNCION STATICAS  ******//
    public static function crearSmartLink($chatBitHeaderID, $company_id, $customer_id)
    {
        $customer = Customer::find($customer_id);
        $company = Company::find($company_id);
        $PRECIO = 0;
        $servicio = BotCustomerResponse::where('chat_bot_header_id', $chatBitHeaderID)->where('campo_name', 'servicio')->first();
        $link = 'no link';
        if (isset($servicio->response_customer)) {
            $data = [
                'service' => $servicio->response_customer,
                'empresa' => $company->code_intel,
            ];
            $json = json_encode($data);
            $url = $company->url . "/restful/api-sigcrm/show-service-price";
            $options = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => $json
                ]
            ]);
            $result = file_get_contents($url, false, $options);
            $resultObject = json_decode($result);
            $PRECIO = $resultObject->PRECIO;
            $info = [];
            $info = [
                "publicMerchantId" => "20000000101840683000",
                "merchantName" => "Global",
                "paymentConfig" => [
                    "paymentType" => "unique",
                    "amount" => [
                        "currency" => "USD",
                        "subtotalIva" => $PRECIO,
                        "subtotalIva0" => 0,
                        "iva" => 0,
                    ],
                    "paymentMethod" => [
                        "credit-card"
                    ]
                ],

                "generalConfig" => [
                    "productName" => "Cita Médica",
                    "description" => "<p>Cita</p>",
                    "productImage" => "https://kushki-static.s3.amazonaws.com/smartlinks/product-image.png",
                    "brandLogo" => "https://kushki-static.s3.amazonaws.com/smartlinks/logo.png",
                    "executionLimit" => 1,
                    "showTimer" => false,
                    "enabled" => true,
                    "termsAndConditions" => "No hay reversos",
                    "promotionalText" => "",
                    "buyButtonText" => "",
                ],

                "styleAndStructure" => [
                    "structure" => "checkout"
                ],

                "contact" => [
                    "email" => 'pacjohn92@gmail.com',
                    // "phoneNumber" => $customer->celular_1
                    "phoneNumber" => "0996432301"
                ],

                "formConfig" => [
                    [
                        "label" => "JOHN FABRICIO TELLO CULQUI",
                        // "label" => $customer->nombres . ' ' . $customer->apellidos,
                        "type" => "input",
                        "split" => false,
                        "required" => true,
                        "disabled" => false,
                        // "name" => "JOHN FABRICIO TELLO CULQUI",
                        // "placeholder" => "JOHN FABRICIO TELLO CULQUI"
                        "name" => "nombresyapellidos",
                        "placeholder" => "Nombres y apellidos"
                    ]
                ]
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api-uat.kushkipagos.com/smartlink/v2/smart-link');
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            if (isset($response->smartLinkUrl)) {
                $link = $response->smartLinkUrl;
                $findme   = 'global/';
                $posGlobal = strpos($link, $findme);
                $charGlobal = substr($link, $posGlobal);
                $findSlash   = '/';
                $posSmartLink = strpos($charGlobal, $findSlash);
                $charSmartLink = substr($charGlobal, ($posSmartLink + 1));
                $chatBotHeader = ChatBotHeader::find($chatBitHeaderID);
                $chatBotHeader->pay_smart_link_url = $link;
                $chatBotHeader->pay_smart_link = $charSmartLink;
                $chatBotHeader->pay_status = 'pending';
                $chatBotHeader->save();
            } else if (isset($response->code) && isset($response->message)) {
                $link = 'CODIGO: ' . $response->code . '- RESPUESTA: ' . $response->message;
            } else {
                $link = 'ERROR AL CONECTARSE AL SERVICIO';
            }
        }
        $dataSmartLink = [];
        $dataSmartLink = [
            'link' => $link,
            'precio' => $PRECIO,
        ];

        return $dataSmartLink;
    }

    public static function crearPacienteAtencionPrefacturaFacturaSigcenter($company_id, $customer_id, $precio, $chatBotHeaderID)
    {
        $customer = Customer::find($customer_id);
        $company = Company::find($company_id);
        $link = 'SIN LINK';
        //****** CREAR PACIENTE ATENCION PREFACTURA ******//


        $region = [
            'name' => 'CREAR PACIENTE'
        ];
        Region::create($region);
        if (true) {
            $info = [];
            $info = [
                "empresa" => $company->code_intel,
                "ruc" => $customer->numero_documento,
                "Paciente" => [
                    "ID_TIPO_IDENTIFICACION" => 1,
                    "IDENTIFICACION" => $customer->numero_documento,
                    "APELLIDOS" => $customer->apellidos,
                    "NOMBRES" => $customer->nombres,
                    "numero_historia_clinica" => $customer->numero_documento,
                    "SEXO" => "",
                    "estado_civil_id" => "",
                    "FECHA_NAC" => $customer->birth_date,
                    "tipos_clientes_id" => 2,
                    "ID_PROCEDENCIA" => "",
                    "referido_id" => "",
                    "EMAIL" => $customer->correo,
                    "CELULAR" => $customer->celular_1,
                    "segundo_correo" => "",
                    "TELEFONO" => "",
                    "ocupacion" => "",
                    "lugar_trabajo" => "",
                    "DIRECCION" => "DIRECCION POR DEFECTO",
                    "telefono_1" => "",
                    "telefono_2" => "",
                    "ciudad_id" => "",
                    "parroquia_id" => "",
                    "pais_id" => "",
                    "persona_contacto" => "",
                    "telefono_persona_contacto" => "",
                    "parentescoPersonaContacto" => "",
                    "nivelAcademico_id" => "",
                    "lateralidad" => "",
                    "grupoSanguineo_id" => "",
                    "religionId" => ""
                ],
            ];



            $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/save-paciente";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            if ($response->code == '200' or $response->code == '300') {
                $paciente = $response->paciente_id;
                $region = [
                    'name' => 'PACIENTE' . $paciente
                ];
                Region::create($region);
                // dd($response->msg, $response->paciente_id);
            } else {
                // dd($response->msg);
            }
        }



        $region = [
            'name' => 'CREAR ATENCION'
        ];
        Region::create($region);
        $sede = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'sede')->orderBy('id', 'DESC')->first();
        $procedimiento = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'servicio')->orderBy('id', 'DESC')->first();
        $afiliacion = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'afiliacion')->orderBy('id', 'DESC')->first();
        if (true) {
            $info = [];
            $info = [
                "paciente" => $paciente,
                "empresa" => $company->code_intel,
                "DocSolicitudPaciente" => [
                    "sede_id" => $sede->response_customer,
                    "publico" => "0",
                    "afiliacionId" => $afiliacion->response_customer,
                    "cargar" => "",
                    "parentescoId" => "1",
                    "tipoIdentificacionAfiliado" => "1",
                    "identificacionAfiliado" => "",
                    "apellidosAfiliado" => "",
                    "nombresAfiliado" => "",
                    "proSol" => [
                        [
                            "id" => "",
                            "disable" => "",
                            "ingreso" => "",
                            "Procedimiento" => $procedimiento->response_customer,
                            "ProcedimientoAfiliacion" => "",
                            "duplicar" => "",
                            "ojo_id" => "",
                        ],
                    ],
                    "tipoAfiliacion" => "",
                    "numeroAprobacion" => "",
                    "tipoPlan" => "",
                    "fecha_registro" => "",
                    "fecha_seguro_campesino" => "",
                    "fecha_vigencia" => "",
                    "cod_derivacion" => "",
                    "num_secuencial_derivacion" => "",
                    "num_historia" => "",
                    "enfermedad_catastrofica" => "",
                    "discapacidad" => "",
                    "jefe_hogar" => "",
                    "presuntivosEnfermedadesExterna" => [
                        [
                            "id" => "",
                            "idEnfermedades" => "",
                            "ojo_id" => "",
                            "evidencia" => "0"
                        ],
                    ],
                    "examenFisico" => "",
                    "perfilId" => "",
                    "observacion" => "CREADO DESDE EL CRM"
                ],
            ];


            $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/save-atention";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            if ($response->code == '200') {
                $docSoli = $response->doc_soli_id;
                // dd($response->msg, $response->doc_soli_id);
            } else {
                // dd($response->msg);
            }
        }




        $region = [
            'name' => 'CREAR PREFACTURA' . $docSoli
        ];
        Region::create($region);
        if (true) {
            $info = [];
            $info = [
                "pks" => $docSoli,
                "empresa" => $company->code_intel,
            ];
            $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/bulk-facturar";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            if ($response->code == '200') {
                $idF = $response->idF;
                // dd($response->msg, $response->doc_soli_id);
            } else {
                // dd($response->msg);
            }
        }



        $region = [
            'name' => 'CREAR FORMA PAGO:' . $idF
        ];
        Region::create($region);
        $precio = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'servicio')->first();
        $chatCabecera = ChatBotHeader::find($chatBotHeaderID);
        if (true) {
            $info = [];
            $info = [
                "idF" => $idF,
                "tipoPago" => $chatCabecera->pay_payment_method,
                "empresa" => $company->code_intel,
                "FacturaFormapago" => [
                    "fecha_pago" => date('Y-m-d H:i:s'),
                    "totalPagar" => $precio->response_opcion . ".000000",
                    "totalPagarAux" => $precio->response_opcion,
                    "montoPagado" => $precio->response_opcion . ".000000",
                    "anticipo" => "0",
                    "banco_id" => "",
                    "numero_cheque" => "",
                    "numero_deposito" => "",
                    "numero_cuenta" => "",
                    "tarjeta_banco_id" => "",
                    "plan_id" => "",
                    "comision_tarjeta" => "",
                    "comision_tarjeta_gasto" => "0",
                    "numero_referencia" => "",
                    "numero_lote_tarjeta" => "",
                    "numero_aprobacion_tarjeta" => "",
                    "identificacion" =>  $customer->numero_documento,
                    "nombreApellidos" => $customer->apellidos . ' ' . $customer->nombres,
                    "devueltos" => "",
                    "cuentas" => "",
                    "notasCreditos" => [
                        "notaCredito_id" => "2",
                        "monto" => "1.34"
                    ],
                    "rosita" => [
                        [
                            "otroAlmacenPago_id" => "",
                            "monto" => ""
                        ],
                    ],
                    "observacion" => "FORMA DE PAGO DESDE EL CRM"
                ],
            ];
            $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/create-forma-pago";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            // dd($response);
        }




        $region = [
            'name' => 'CREAR AGENDAMIENTO' . $docSoli
        ];
        Region::create($region);
        if (true) {
            $respuestaHoras = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'horario')->first();
            $fechaIngresada = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'fecha_agenda')->first();
            $horaCompletaInicio = substr($respuestaHoras->response_opcion, 0, 8);
            $horaCompletaFin = substr($respuestaHoras->response_opcion, -8);
            $horaMinutosInicio = substr($respuestaHoras->response_opcion, 0, 5);
            $horaMinutosFin = substr($respuestaHoras->response_opcion, -8, -3);
            $horaFin = substr($respuestaHoras->response_opcion, -8, -6);
            $minutosFin = substr($respuestaHoras->response_opcion, -5, -3);
            $fechaHOY = $fechaIngresada->response_customer . ' ' . $horaCompletaInicio;
            $trabajador = BotCustomerResponse::where('chat_bot_header_id', $chatBotHeaderID)->where('campo_name', 'trabajador')->first();
            $date = '2022-06-26';
            $diaFormatoCompleto = KushkiController::getDayDate($fechaIngresada->response_customer);
            $info = [];
            $info = [
                "empresa" => $company->code_intel,
                "pks" => $docSoli,
                "fechaInicio" => $fechaHOY,
                "AgendaDoctor" => [
                    "ID_TRABAJADOR" => $trabajador->response_customer,
                    "ID_OJO" => "",
                    "ID_ANESTESIA" => "",
                    "ID_ANESTESIOLOGO" => "",
                    "DESCRIPCION" => "AGENDADO DESDE EL CRM",
                    "lente" => "0",
                    "FECHAINICIO" => $diaFormatoCompleto,
                    "HORAINICIO" => $horaMinutosInicio,
                    "HORAFIN" => $horaMinutosFin
                ],
                "hour" => $horaFin,
                "minute" => $minutosFin,
                // "meridian" => "PM"
            ];
            $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/create-agenda-doctor";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            if ($response->code == '200') {
                $region = [
                    'name' => 'msg' . $response->code
                ];
                Region::create($region);
                // dd($response->msg, $response->paciente_id);
            } else {
                $region = [
                    'name' => 'msg' . $response->code
                ];
                Region::create($region);
            }
        }

        $facturaDatos = ChatBotHeader::find($chatBotHeaderID);
        if ($facturaDatos->factura_ruc !== null) {
            $facturaDatos->factura_ruc;
            $facturaDatos->factura_nombres;
            $facturaDatos->factura_apellidos;
            $facturaDatos->factura_nacimiento;
            $facturaDatos->factura_email;
            $facturaDatos->factura_celular;
            $facturaDatos->factura_direccion;
            $info = [];
            $info = [
                "empresa" => $company->code_intel,
                "ruc" => $facturaDatos->factura_ruc,
                "Paciente" => [
                    "ID_TIPO_IDENTIFICACION" => 1,
                    "IDENTIFICACION" => $facturaDatos->factura_ruc,
                    "APELLIDOS" => $facturaDatos->factura_apellidos,
                    "NOMBRES" => $facturaDatos->factura_nombres,
                    "numero_historia_clinica" => $facturaDatos->factura_ruc,
                    "SEXO" => "",
                    "estado_civil_id" => "",
                    "FECHA_NAC" => $facturaDatos->factura_nacimiento,
                    "tipos_clientes_id" => 2,
                    "ID_PROCEDENCIA" => "",
                    "referido_id" => "",
                    "EMAIL" => $facturaDatos->factura_email,
                    "CELULAR" => $facturaDatos->factura_celular,
                    "segundo_correo" => "",
                    "TELEFONO" => "",
                    "ocupacion" => "",
                    "lugar_trabajo" => "",
                    "DIRECCION" => $facturaDatos->factura_direccion,
                    "telefono_1" => "",
                    "telefono_2" => "",
                    "ciudad_id" => "",
                    "parroquia_id" => "",
                    "pais_id" => "",
                    "persona_contacto" => "",
                    "telefono_persona_contacto" => "",
                    "parentescoPersonaContacto" => "",
                    "nivelAcademico_id" => "",
                    "lateralidad" => "",
                    "grupoSanguineo_id" => "",
                    "religionId" => ""
                ],
            ];
            $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/save-paciente";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch));
            $error = curl_error($ch);
            curl_close($ch);
            if ($response->code == '200' or $response->code == '300') {
                $paciente = $response->paciente_id;
                $region = [
                    'name' => 'PACIENTE' . $paciente
                ];
                Region::create($region);
                $info = [];
                $info = [
                    "empresa" => $company->code_intel,
                    "idF" => $idF,
                    "idP" => $paciente
                ];
                $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/cambiar-datos-facturar";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = json_decode(curl_exec($ch));
                $error = curl_error($ch);
                curl_close($ch);
                if ($response->code == '200') {
                    $region = [
                        'name' => $response->msg
                    ];
                    Region::create($region);
                }
            } else {
                // dd($response->msg);
            }
        }







        // $region = [
        //     'name' => 'CREAR FACTURA'
        // ];
        // Region::create($region);
        // if (true) {
        //     $info = [];
        //     $info = [
        //         "empresa" => $company->code_intel,
        //         "idF" => $idF,
        //         "Facturas" => [
        //             "codigo_factura" => "",
        //             "fecha_facturacion" => date('Y-m-d H:i:s'),
        //         ],
        //     ];
        //     $urlCreateUpdateCustomer = $company->url . "/restful/api-sigcrm/generar-factura";
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $urlCreateUpdateCustomer);
        //     curl_setopt($ch, CURLOPT_POST, TRUE);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($info));
        //     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en", "Content-Type: application/json", "Private-Merchant-Id: " . 'dc8b93e881e44ecf99dc6b3f6dc4f732'));
        //     curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //     $response = json_decode(curl_exec($ch));
        //     $error = curl_error($ch);
        //     curl_close($ch);
        //     if ($response->code == '200') {
        //         $link = $response->pdfFactura;
        //         $region = [
        //             'name' => 'msg' . $response->msg . 'link: ' .  $response->pdfFactura
        //         ];
        //         Region::create($region);
        //     } else {
        //         $region = [
        //             'name' => 'msg' . $response->msg
        //         ];
        //         Region::create($region);
        //     }
        // }


        $region = [
            'name' => '*****FIN*****'
        ];
        Region::create($region);
        $dataRIDE = [
            'link' => $link
        ];
        return $dataRIDE;
        //**** FIN CREAR PACIENTE ATENCION PREFACTURA ****//
    }

    public static function getDayDate($fecha)
    {
        $timestamp = strtotime($fecha);
        $day = date('D', $timestamp);
        $diaNumero = date('d', $timestamp);
        $anio = date('Y', $timestamp);
        switch ($day) {
            case 'Mon':
                $dia = "Lunes";
                break;
            case 'Tue':
                $dia = "Martes";
                break;
            case 'Wed':
                $dia = "Miércoles";
                break;
            case 'Thu':
                $dia = "Jueves";
                break;
            case 'Fri':
                $dia = "Viernes";
                break;
            case 'Sat':
                $dia = "Sábado";
                break;
            case 'Sun':
                $dia = "Domingo";
                break;
        }
        $month = date('M', $timestamp);
        switch ($month) {
            case 'Jan':
                $mes = "Enero";
                break;
            case 'Feb':
                $mes = "Febrero";
                break;
            case 'Mar':
                $mes = "Marzo";
                break;
            case 'Apr':
                $mes = "Abril";
                break;
            case 'May':
                $mes = "Mayo";
                break;
            case 'Jun':
                $mes = "Junio";
                break;
            case 'Jul':
                $mes = "Julio";
                break;
            case 'Aug':
                $mes = "Agosto";
                break;
            case 'Sep':
                $mes = "Septiembre";
                break;
            case 'Oct':
                $mes = "Octubre";
                break;
            case 'Nov':
                $mes = "Noviembre";
                break;
            case 'Dec':
                $mes = "Diciembre";
                break;
        }
        $fechaFormato = $dia . ', ' . $diaNumero . ' ' . $mes . ' ' . $anio;
        return $fechaFormato;
    }

    //****  FIN FUNCION STATICAS  ****//
}
