<?php

namespace App\Http\Controllers\Arbol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuRol;
use App\Models\Admin\Menu;
use Response;

class ArbolController extends Controller
{

    public function index()
    {
        $roles = Rol::where('status', true)->get();
        return view('arbol/index')
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $datos = [
            'user_create' => Auth::user()->id,
            'nombre' => strtoupper($request->input('nombre')),
            'observation' => strtoupper($request->input('observation')),
            'menu_type' => strtoupper($request->input('menu_type')),
        ];
        Rol::create($datos);
    }

    public function destroy($id)
    {
        $roles = Rol::find($id);
        $roles->status = false;
        $roles->save();
        dd($id);
    }

    public function tree($role_id)
    {
        $menus = ArbolController::getMenu();
        foreach ($menus as $key => $value) {
            $existe = MenuRol::where('rol_id', $role_id)->where('menu_id', $value['id']);
            if ($existe->count() > 0) {
                $menus[$key]['activo'] = true;
            } else {
                $menus[$key]['activo'] = false;
            }

            if (count($value['submenu']) > 0) {
                foreach ($value['submenu'] as $key2 => $submenu) {
                    $existe2 = MenuRol::where('rol_id', $role_id)->where('menu_id', $submenu['id']);
                    if ($existe2->count() > 0) {
                        $menus[$key]['submenu'][$key2]['activo'] = true;
                    } else {
                        $menus[$key]['submenu'][$key2]['activo'] = false;
                    }
                }
            }
        }
        //        dd($menus);
        //        $options = MenuRol::where('rol_id', '=', 1)->orderBy('rol_id')->get();
        //        $total_options = $options->load('menu')->toArray();
        //        return $this->buildTree(0, $total_options, $role_id);
        return $menus;
    }

    public static function getMenu($front = false)
    {
        $menus = new Menu();
        $padres = $menus->getPadresArbol($front);
        $menuAll = [];
        foreach ($padres as $line) {
            if ($line['menu_id'] != 0)
                break;
            $item = [array_merge($line, ['submenu' => $menus->getHijosArbol($padres, $line)])];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }

    public function buildTree($parent, $array, $role_id)
    {
        $has_children = false;
        $menu = '';
        foreach ($array as $key => $value) {
            //            dd($value);
            if ($value['menu']['menu_id'] == $parent) {
                if ($has_children === false && $parent) {
                    $has_children = true;
                    $menu .= '<ul >' . "\n";
                }
                $menu .= '<li>' . "\n";
                $checked = (MenuRol::where('menu_id', '=', $value['menu']['id'])->where('rol_id', '=', $role_id)->first() != NULL) ? 'checked' : '';
                $content_option = ($value['menu']['url'] != '#') ? '<label class="checkbox inline-block"> <input class="checks" type="checkbox" alt="' . $role_id . '" ' . $checked . ' id="' . $value['menu']['id'] . '" name="checkbox-inline"><i></i>' . $value['menu']['nombre'] . '</label>' : '<i class="fas fa-lg fa-minus-circle"></i> ' . $value['menu']['nombre'];
                $menu .= '<span>' . $content_option . '</span>' . " \n";
                if ($value['menu']['url'] != '#') {
                    //                    foreach (Action::all() as $action) {
                    //                        $option_rol = OptionRole::where('option_id', '=', $value['option']['id'])->where('role_id', '=', $role_id)->first();
                    //                        $option_rol_id = ($option_rol != NULL) ? $option_rol->id : 0;
                    //                        $checked = (RoleOptionAction::where('option_role_id', '=', $option_rol_id)->where('action_id', '=', $action->id)->first() != NULL) ? 'checked' : '';
                    //                        $create = '<label class="checkbox inline-block" style="margin-left: 1px;"  > <input class="action-checks" onclick="changeAction(this,' . $action->id . ',' . $option_rol_id . ')" type="checkbox" ' . $checked . ' name="checkbox-inline"><i></i><span style="padding: 4px;color: ' . $action->color . ';" class="glyphicon ' . $action->icon . '"></span></label>';
                    //                        $menu .= '<span class="visible-lg-inline-block" style="width: 50px;padding: 2px;">' . $create . '</span>' . " \n";
                    //                    }
                }
                $menu .= $this->buildTree($value['menu']['id'], $array, $role_id);
                $menu .= "</li>\n";
            }
        }
        if ($has_children === true && $parent)
            $menu .= "</ul>\n";

        return $menu;
    }

    public function cambioMenu(Request $requets, $id)
    {
        $rol = Rol::find($id);
        $rol->menu_type = $requets->input('menu_type');
        $rol->save();
        return Response::json(true);
    }
}
