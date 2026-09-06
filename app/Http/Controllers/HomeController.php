<?php

namespace App\Http\Controllers;

use App\Models\ChatBotDetail;
use App\Models\ChatBotHeader;
use App\Models\Company;
use App\Models\Rol;
use App\User;
use Facade\FlareClient\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuarioRol = DB::table('users')
            ->select('rol.menu_type')
            ->join('usuario_rol', 'users.id', '=', 'usuario_rol.user_id')
            ->join('rol', 'usuario_rol.rol_id', '=', 'rol.id')
            ->where('users.id', Auth::user()->id)
            ->limit(1)
            ->first();

        // dd($usuarioRol);

        switch ($usuarioRol->menu_type) {
            case 'AGENTE':
                // case 'OTRO_CASO':
                $mensajesEnviados = ChatBotDetail::where('company_id', Auth::user()->company_id)
                    ->where('user_write_id', Auth::user()->id)
                    ->where('status', true)
                    ->get()
                    ->count();

                $chatTotales = ChatBotDetail::where('company_id', Auth::user()->company_id)
                    ->where('user_write_id', Auth::user()->id)
                    ->where('status', true)
                    ->groupBy('chat_bot_header_id')
                    ->get()
                    ->count();

                $chatResueltos = ChatBotHeader::where('company_id', Auth::user()->company_id)
                    ->where('user_assigned_id', Auth::user()->id)
                    ->where('status_venta', 'RESUELTO')
                    ->where('status', false)
                    ->get()
                    ->count();

                $chatVendidos = ChatBotHeader::where('company_id', Auth::user()->company_id)
                    ->where('user_assigned_id', Auth::user()->id)
                    ->where('status_venta', 'VENDIDO')
                    ->get()
                    ->count();

                return view('home/home-agente')
                    ->with('mensajesEnviados', $mensajesEnviados)
                    ->with('chatTotales', $chatTotales)
                    ->with('chatResueltos', $chatResueltos)
                    ->with('chatVendidos', $chatVendidos);
                break;
            case 'ADMINISTRADOR':
                $nombreRolAgente = 'AGENTE';
                $usuarioAgentes = DB::table('users')
                    ->select('users.id')
                    ->join('usuario_rol', 'users.id', '=', 'usuario_rol.user_id')
                    ->join('rol', 'usuario_rol.rol_id', '=', 'rol.id')
                    ->where('rol.nombre', $nombreRolAgente)
                    ->get()
                    ->count();

                $mensajesTotales = ChatBotDetail::where('company_id', Auth::user()->company_id)
                    ->where('status', true)
                    ->where('bot', true)
                    ->where('action', false)
                    ->get()
                    ->count();

                $conversacionesTotales = ChatBotHeader::where('company_id', Auth::user()->company_id)
                    ->get()
                    ->count();

                $conversacionesVendidas = ChatBotHeader::where('company_id', Auth::user()->company_id)
                    ->where('status_venta', 'VENDIDO')
                    ->get()
                    ->count();

                return view('home/home-supervisor')
                    ->with('usuarioAgentes', $usuarioAgentes)
                    ->with('mensajesTotales', $mensajesTotales)
                    ->with('conversacionesTotales', $conversacionesTotales)
                    ->with('conversacionesVendidas', $conversacionesVendidas);
                break;
            case 'SUPERADMINISTRADOR':
                $totalEmpresas = Company::where('status', true)
                    ->get()
                    ->count();
                $usuariosTotales = User::where('status', true)
                    ->get()
                    ->count();

                $mensajesEnviados = ChatBotDetail::where('status', true)
                    ->get()
                    ->count();

                $chatTotales = ChatBotHeader::all()
                    ->count();

                return view('home/home')
                    ->with('totalEmpresas', $totalEmpresas)
                    ->with('usuariosTotales', $usuariosTotales)
                    ->with('mensajesEnviados', $mensajesEnviados)
                    ->with('chatTotales', $chatTotales);
                break;
            case 'DEFAULT':
                $company = Company::find(Auth::user()->company_id);
                $user = User::find(Auth::user()->id);
                return view('home/default')
                    ->with('company', $company)
                    ->with('user', $user);
                break;

            default:
                $company = Company::find(Auth::user()->company_id);
                $user = User::find(Auth::user()->id);
                return view('home/default')
                    ->with('company', $company)
                    ->with('user', $user);
        }
    }

    public function graficaAgente()
    {
        $lunes = date("Y-m-d", strtotime('monday this week'));
        $martes = date("Y-m-d", strtotime('tuesday this week'));
        $miercoles = date("Y-m-d", strtotime('wednesday this week'));
        $jueves = date("Y-m-d", strtotime('thursday this week'));
        $viernes = date("Y-m-d", strtotime('friday this week'));
        $sabado = date("Y-m-d", strtotime('saturday this week'));
        $domingo = date("Y-m-d", strtotime('sunday this week'));

        $data = [];
        $chatTotalesLunes = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $lunes)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Lunes</b><br>' . $lunes, $chatTotalesLunes];

        $chatTotalesMartes = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $martes)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Martes</b><br>' . $martes, $chatTotalesMartes];

        $chatTotalesMiercoles = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $miercoles)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Miércoles</b><br>' . $miercoles, $chatTotalesMiercoles];

        $chatTotalesJueves = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $jueves)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Jueves</b><br>' . $jueves, $chatTotalesJueves];

        $chatTotalesViernes = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $viernes)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Viernes</b><br>' . $viernes, $chatTotalesViernes];


        $chatTotalesSabado = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $sabado)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Sábado</b><br>' . $sabado, $chatTotalesSabado];

        $chatTotalesDomingo = ChatBotDetail::where('company_id', Auth::user()->company_id)
            ->where('user_write_id', Auth::user()->id)
            ->where('date_created', $domingo)
            ->where('status', true)
            ->get()
            ->count();
        $data[] = ['<b>Domingo</b><br>' . $domingo, $chatTotalesDomingo];

        return Response::json($data);
    }

    public function graficaAgenteSupervisor()
    {
        if (true) {
            $meses[] = [
                'mes' => 'Enero',
                'code' => '01',
            ];
            $meses[] = [
                'mes' => 'Febrero',
                'code' => '02',
            ];
            $meses[] = [
                'mes' => 'Marzo',
                'code' => '03',
            ];
            $meses[] = [
                'mes' => 'Abril',
                'code' => '04',
            ];
            $meses[] = [
                'mes' => 'Mayo',
                'code' => '05',
            ];
            $meses[] = [
                'mes' => 'Junio',
                'code' => '06',
            ];
            $meses[] = [
                'mes' => 'Julio',
                'code' => '07',
            ];
            $meses[] = [
                'mes' => 'Agosto',
                'code' => '08',
            ];
            $meses[] = [
                'mes' => 'Septiembre',
                'code' => '09',
            ];
            $meses[] = [
                'mes' => 'Octubre',
                'code' => '10',
            ];
            $meses[] = [
                'mes' => 'Noviembre',
                'code' => '11',
            ];
            $meses[] = [
                'mes' => 'Diciembre',
                'code' => '12',
            ];
        }

        $mesesTotales = [];
        $mesesIndividual = [];
        foreach ($meses as $key => $value) {
            $year = date('Y');
            $first_date = $year . '-' . $value['code'] . '-01';
            $last_date = date('Y-m-t', strtotime($first_date));
            $mensajesTotalesMes = ChatBotDetail::where('company_id', Auth::user()->company_id)
                ->where('status', true)
                ->where('bot', true)
                ->where('action', false)
                ->whereBetween('date_created', [$first_date, $last_date])
                ->get()
                ->count();

            $mesesTotales[] = [
                'name' => $value['mes'],
                'y' => $mensajesTotalesMes,
                'drilldown' => $value['mes'],
            ];


            $nombreRolAgente = 'AGENTE';
            $usuarioAgentes = DB::table('users')
                ->select('users.id', 'users.username')
                ->join('usuario_rol', 'users.id', '=', 'usuario_rol.user_id')
                ->join('rol', 'usuario_rol.rol_id', '=', 'rol.id')
                ->where('rol.nombre', $nombreRolAgente)
                ->get();

            $agente = [];
            $agenteSolo = [];
            $dataAgente = [];
            foreach ($usuarioAgentes as $key2 => $val) {
                if ($key2 == 0) {
                    //calcular bot
                    $mensajesEnviadosAgenteMes = ChatBotDetail::where('company_id', Auth::user()->company_id)
                        ->where('user_write_id', null)
                        ->where('bot', true)
                        ->where('action', false)
                        ->where('status', true)
                        ->whereBetween('date_created', [$first_date, $last_date])
                        ->get()
                        ->count();

                    $agenteSolo = ['Bot', $mensajesEnviadosAgenteMes];
                    array_push($dataAgente, $agenteSolo);
                    $agente = [
                        'name' => $value['mes'],
                        'id' => $value['mes'],
                        'data' => $dataAgente,
                    ];
                }



                $mensajesEnviadosAgenteMes = ChatBotDetail::where('company_id', Auth::user()->company_id)
                    ->where('user_write_id', $val->id)
                    ->where('status', true)
                    ->whereBetween('date_created', [$first_date, $last_date])
                    ->get()
                    ->count();

                $agenteSolo = [$val->username, $mensajesEnviadosAgenteMes];
                array_push($dataAgente, $agenteSolo);
                $agente = [
                    'name' => $value['mes'],
                    'id' => $value['mes'],
                    'data' => $dataAgente,
                ];
            }
            array_push($mesesIndividual, $agente);
        }
        $dataTodo = [
            'mesesTotales' => $mesesTotales,
            'mesesIndividual' => $mesesIndividual,
        ];
        return Response::json($dataTodo);
    }
}
