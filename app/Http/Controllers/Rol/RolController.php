<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{

    public function index()
    {
        $datas = Rol::orderBy('id')->get();
        $cantidad = count($datas);
        return view('rol/index')
            ->with('cantidad', $cantidad)
            ->with('datas', $datas);
    }

    public function create()
    {

        return view('rol/create');
    }

    public function store(Request $request)
    {
        Rol::create($request->all());
        return redirect('rol')->with('mensaje', 'Rol creado con exito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Rol::findOrFail($id);
        return view('rol/edit')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        Rol::findOrFail($id)->update($request->all());
        return redirect('rol')->with('mensaje', 'Rol actualizado con exito');
    }

    public function destroy(Request $request, $id)
    {

        if ($request->ajax()) {
            if (Rol::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
