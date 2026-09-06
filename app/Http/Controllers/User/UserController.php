<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Rol;
use App\Models\UsuarioRol;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;
use Image;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Auth;
use Illuminate\Support\Facades\URL;

//use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function index()
    {
        return view('usuarios/index');
    }

    public function indexData()
    {
        $user = User::all();
        foreach ($user as $use) {
            $rol = UsuarioRol::where('user_id', $use->id)->first();
            $rol_name = Rol::find($rol->rol_id)->nombre;
            $use->rol_name = $rol_name;
        }
        return $user;
    }

    public function create()
    {
        $roles = Rol::all();
        $empresa = Company::all();
        return view('usuarios/create')
            ->with('empresa', $empresa)
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {
        foreach ($request->input('empresa') as $key => $value) {
            if ($key == 0) {
                $empresa = $value;
            }
        }
        if ($key !== 0) {
            $separado = implode(",", $request->input('empresa'));
        } else {
            $separado = '';
        }
        $usuario = new User();
        $usuario->company_id = $empresa;
        $usuario->company_varias = $separado;
        $usuario->firstname = strtoupper(request('firstname'));
        $usuario->lastname = strtoupper(request('lastname'));
        $usuario->username = request('username');
        $usuario->ruc = request('ruc');
        $usuario->email = request('email');
        $usuario->password = Hash::make(request('password'));
        $usuario->remember_token = bcrypt(request('password'));
        $usuario->token = request('password');
        $usuario->save();
        if ($request->file('photo') !== null) {
            $imagen = $request->file('photo');
            $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('uploads/users');
            $request->photo->move($destino, $nombre);
            $usuario->photo = $nombre;
            $usuario->save();
        }
        $rol = new UsuarioRol();
        $rol->rol_id = request('rol');
        $rol->user_id = $usuario->id;
        $rol->status = true;
        $rol->save();
        //enviar email
        //        $datos=[
        //            'usuario' => request('username'),
        //            'clave' => request('password')
        //        ];
        //        Mail::send("email.welcome_user", $datos, function ($mensaje){
        //           $mensaje->to("pacjohn92@gmail.com", "MANUEL PEREZ")->subject("ONIX usuario y clave del sistema"); 
        //        });
        return redirect('/usuarios');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $user->rol = UsuarioRol::where('user_id', $id)->first()->rol_id;
        $roles = Rol::all();
        $empresa = Company::where('status', true)->get();
        if ($user->company_varias !== null && $user->company_varias !== '') {
            $empresas = explode(",", $user->company_varias);
            foreach ($empresa as $value) {
                $indice = in_array($value->id, $empresas);
                if ($indice) {
                    $data[] = [
                        'id' => $value->id,
                        'name' => $value->company_name,
                        'status' => true
                    ];
                } else {
                    $data[] = [
                        'id' => $value->id,
                        'name' => $value->company_name,
                        'status' => false
                    ];
                }
            }
        } else {
            foreach ($empresa as $value) {
                $data[] = [
                    'id' => $value->id,
                    'name' => $value->company_name,
                    'status' => false
                ];
            }
        }
        return view('usuarios/edit')
            ->with('roles', $roles)
            ->with('empresa', $empresa)
            ->with('empresas', $data)
            ->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        foreach ($request->input('empresa') as $key => $value) {
            if ($key == 0) {
                $empresa = $value;
            }
        }
        if ($key !== 0) {
            $separado = implode(",", $request->input('empresa'));
        } else {
            $separado = '';
        }
        $user = User::find($id);
        $user->company_id = $empresa;
        $user->company_varias = $separado;
        $user->firstname = strtoupper(request('firstname'));
        $user->lastname = strtoupper(request('lastname'));
        $user->username = request('username');
        $user->ruc = request('ruc');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->remember_token = bcrypt(request('password'));
        $user->token = request('password');
        $user->status = true;
        $user->save();
        if ($request->file('photo') !== null) {
            $imagen = $request->file('photo');
            if ($user->photo !== null) {
                $nombre = $user->photo;
                $borrar = public_path() . '/uploads/users/' . $user->photo;
                unlink($borrar);
            } else {
                $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            }
            $destino = public_path('uploads/users');
            $request->photo->move($destino, $nombre);
            $user->photo = $nombre;
            $user->save();
        }
        $rol = UsuarioRol::where('user_id', $id)->first();
        $rol->rol_id = request('rol');
        $rol->save();
        return redirect('/usuarios')->with('mensaje', 'Usuario Editado exitosamente');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = false;
        $user->save();
        return $user;
    }

    public function darUsername($nombre, $apellido)
    {
        $inicial = strtolower(substr($nombre, 0, 1) . $apellido);
        $username = User::where('username', $inicial);
        if ($username->count() !== 0) {
            $i = 0;
            $j = 1;
            while ($i == 0) {
                $valor = $inicial . $j;
                $username = User::where('username', $valor);
                if ($username->count() == 0) {
                    $i = 1;
                }
                $j++;
            }
            return Response::json($valor);
        } else {
            return Response::json($inicial);
        }
    }

    public function profile()
    {
        $rolName = '';
        $usuarioRol = UsuarioRol::where('user_id', Auth::user()->id)->first();
        if ($usuarioRol != null && $usuarioRol != '') {
            $rol = Rol::find($usuarioRol->rol_id);
            $rolName = $rol->nombre;
        }
        return view('usuarios/profile')->with('rolName', $rolName);
    }

    public function actualizarPassword(Request $request)
    {
        $data = $request->input('parametros');
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($data['nueva']);
        $user->remember_token = bcrypt($data['nueva']);
        $user->token = $data['nueva'];
        $user->save();
        return Response::json(true);
    }

    public function verDatos(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'username',
            3 => 'email',
            4 => 'rol_name',
            5 => 'status',
            6 => 'acciones',
        );
        $users = User::where('username', '!=', null);
        $totalData = $users->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        foreach ($request->input('columns') as $columna) {
            switch ($columna['data']) {
                case 'id':
                    $search = $columna['search']['value'];
                    if (empty($search)) {
                        $posts = $users->offset($start)
                            ->limit($limit)
                            ->orderBy('id', 'DESC')
                            ->get();
                    } else {
                        $posts = $users->where('id', 'LIKE', "%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('id', 'DESC')
                            ->get();
                        $totalFiltered = $users->where('id', 'LIKE', "%{$search}%")->count();
                    }
                    break;
                case 'name':
                    $search = $columna['search']['value'];
                    if (empty($search)) {
                        $posts = $users->offset($start)
                            ->limit($limit)
                            ->orderBy('id', 'DESC')
                            ->get();
                    } else {
                        $posts = $users->where('name', 'LIKE', "%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('name', 'DESC')
                            ->get();
                        $totalFiltered = $users->where('name', 'LIKE', "%{$search}%")->count();
                    }
                    break;
                case 'username':
                    $search = $columna['search']['value'];
                    if (empty($search)) {
                        $posts = $users->offset($start)
                            ->limit($limit)
                            ->orderBy('id', 'DESC')
                            ->get();
                    } else {
                        $posts = $users->where('username', 'LIKE', "%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('username', 'DESC')
                            ->get();
                        $totalFiltered = $users->where('username', 'LIKE', "%{$search}%")->count();
                    }
                    break;
                case 'email':
                    $search = $columna['search']['value'];
                    if (empty($search)) {
                        $posts = $users->offset($start)
                            ->limit($limit)
                            ->orderBy('id', 'DESC')
                            ->get();
                    } else {
                        $posts = $users->where('email', 'LIKE', "%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('email', 'DESC')
                            ->get();
                        $totalFiltered = $users->where('email', 'LIKE', "%{$search}%")->count();
                    }
                    break;
            }
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $state) {
                $nestedData['id'] = $state->id;
                $nestedData['name'] = $state->firstname . ' ' . $state->lastname;
                $nestedData['username'] = $state->username;
                $nestedData['email'] = $state->email;
                $rol = UsuarioRol::where('user_id', $state->id)->first();
                $rol_name = Rol::find($rol->rol_id);
                $nestedData['rol_name'] = ($rol_name != null && $rol_name != '') ? $rol_name->nombre : '';
                if ($state->status) {
                    $estado = '<label class="badge bg-info rounded-pill">Activo</label>';
                } else {
                    $estado = '<label class="badge bg-danger rounded-pill">Inactivo</label>';
                }
                $nestedData['status'] = '<a onclick="javascript:cambioEstado(' . $state->id . ')" >' . $estado . '</a>';
                $nestedData['acciones'] = '<a href="' . URL::to(('usuarios/' . $state->id . '/edit')) . '" method="GET" class="btn btn-warning btn-xs" style="color: white;"><i class="fas fa-edit"></i> Editar</a>';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return Response::json($json_data);
    }

    public function cambioEstado($id)
    {
        $user = User::find($id);
        if ($user->status) {
            $new = 0;
        } else {
            $new = 1;
        }
        $usuario = User::find($id);
        $usuario->status = $new;
        $usuario->save();
    }
}
