<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Menu;
use App\Models\MenuRol;
use App\Http\Requests\ValidacionMenu;
use Response;
use DB;

class MenuController extends Controller {

    public function index() {
        $menus = Menu::getMenu();
        return view('menu/index')->with('menus', $menus);
    }

    public function create() {
        return view('menu/create');
    }

    public function store(ValidacionMenu $request) {
        Menu::create($request->all());
        return redirect('menu/create')->with('mensaje', 'Menu creado con exito');
    }

    public function show($id) {
        
    }

    public function edit($id) {
        $data = Menu::findOrFail($id);
        return view('menu/edit')->with('data', $data);
    }

    public function update(ValidacionMenu $request, $id) {
        Menu::findOrFail($id)->update($request->all());
        return redirect('admin/menu')->with('mensaje', 'Menú actualizado con exito');
    }

    public function destroy($id) {
        $menu = Menu::find($id);
        $subMenu = Menu::where('menu_id', $menu->id)->get();
        foreach ($subMenu as $val) {
            if ($val->menu_id != 0) {
                $menuItem = Menu::find($val->id);
                $sql = "DELETE FROM  `menu_rol` WHERE  `menu_id` =  '{$val->id}'";
                $eliminar = DB::delete($sql);
                $menuItem->delete();
            }
        }
        $sql2 = "DELETE FROM  `menu_rol` WHERE  `menu_id` =  '{$id}'";
        $eliminar2 = DB::delete($sql2);
        Menu::destroy($id);
        return redirect('/menu')->with('mensaje', 'Menú eliminado con exito');
    }

    public function guardarOrden(Request $request) {
        if ($request->ajax()) {
            $menu = new Menu;
            $menu->guardarOrden($request->menu);
            return response()->json(['respuesta' => 'ok']);
        } else {
            abort(404);
        }
    }

    public function datosMenu($id) {
        return Response::json(Menu::find($id));
    }

    public function guardarNuevo(Request $request) {
        $datos = $request->input('parametros');
        $data = [
            'nombre' => $datos['nombre'],
            'url' => $datos['url'],
            'icono' => $datos['icono']
        ];
        Menu::create($data);
        return Response::json(true);
    }

    public function updateNemu(Request $request) {
        $datos = $request->input('parametros');
        $menu = Menu::find($datos['edit_menu']);
        $menu->nombre = $datos['nombre'];
        $menu->url = $datos['url'];
        $menu->icono = $datos['icono'];
        $menu->save();
        return Response::json(true);
    }

}
