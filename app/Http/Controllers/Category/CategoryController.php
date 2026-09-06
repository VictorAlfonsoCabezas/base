<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Company;
use Image;

class CategoryController extends Controller {

    public function index() {
        $category = Category::where('type', 2)->where('status', true)->get();
        $cantidad = count($category);
        return view('category/index')
                        ->with('cantidad', $cantidad)
                        ->with('category', $category);
    }

    public function create() {
        return view('category/create');
    }

    public function store(Request $request) {
        $data = [
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "type" => $request->input('type'),
            "type_name" => ($request->input('type') == 1) ? 'ONIX' : 'LAYAPA'
        ];
        $categoria = Category::create($data);
        if ($request->file('photo') !== null) {
            $imagen = $request->file('photo');
            $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('uploads/categories');
            $request->photo->move($destino, $nombre);
            $categoria->photo = $nombre;
            $categoria->save();
        }
// componete para recortar imagenes
//        if ($request->file('photo') !== null) {
//            $extension = $request->file('photo')->getClientOriginalExtension();
//            $random = time();
//            $file_name = $random . '.' . $extension;
//            $path = public_path('uploads/categories/' . $file_name);
//            $image = Image::make($request->file('photo'))
//                    ->resize(370, 250);
//            $image->save($path);
//            $categoria->photo = $file_name;
//            $categoria->save();
//        }
        return redirect('category')->with('mensaje', 'Categoria Creada exitosamente');
    }

    public function edit($id) {
        $value = Category::find($id);
        return view('category/edit')
                        ->with('value', $value);
    }

    public function update(Request $request, Category $category) {
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        $category->type = $request->input('type');
        $category->type_name = ($request->input('type') == 1) ? 'ONIX' : 'LAYAPA';
        $category->save();
        if ($request->file('photo') !== null) {
            $imagen = $request->file('photo');
            if ($category->photo !== null) {
                $nombre = $category->photo;
                $borrar = public_path() . '/uploads/categories/' . $category->photo;
                unlink($borrar);
            } else {
                $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            }
            $destino = public_path('uploads/categories');
            $request->photo->move($destino, $nombre);
            $category->photo = $nombre;
            $category->save();
        }
        return redirect('category')->with('mensaje', 'Categoria Editada exitosamente');
    }

    public function destroy($id) {
        $categoria = Category::find($id);
        $categoria->status = false;
        $categoria->save();
        return redirect('category')->with('mensaje', 'Categoria Eliminada exitosamente');
    }

}
