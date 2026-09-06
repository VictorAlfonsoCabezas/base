<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller {

    public function index() {
        $products = Product::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        $cantidad = count($products);
        return view('product/index')
                        ->with('products', $products)
                        ->with('cantidad', $cantidad);
    }

    public function create() {
        $category = Category::where('type', 3)->get();
        $layapa = Category::where('company_id', Auth::user()->company_id)->where('type', 4)->get();
        return view('product/create')
                        ->with('layapa', $layapa)
                        ->with('category', $category);
    }

    public function store(Request $request) {
//        dd($request->all());
        $data = [
            "name" => $request->input('name'),
            "company_id" => Auth::user()->company_id,
            "description" => $request->input('description'),
            "description_larga" => $request->input('description_larga'),
            "category_product_id" => $request->input('cate_yapa'),
            "unit_measure_id" => $request->input('unidad_id'),
            "unidad_name" => Category::find($request->input('unidad_id'))->title,
            "tipo_iva" => $request->input('tipo_iva'),
            "costo" => $request->input('costo'),
            "precio_a" => $request->input('precio_a'),
            "precio_b" => $request->input('precio_b'),
            "precio_c" => $request->input('precio_c'),
            "tipo" => $request->input('tipo'),
            "stock" => $request->input('stock_inicial'),
            "stock_minimo" => $request->input('stock_minimo')
        ];
        $product = Product::create($data);
        if ($request->file('photo') !== null) {
            $imagen = $request->file('photo');
            $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('uploads/products');
            $request->photo->move($destino, $nombre);
            $product->photo = $nombre;
            $product->save();
        }
        if ($request->file('photoVenta') !== null) {
            $imagen = $request->file('photoVenta');
            $nombre = 'venta' . time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('uploads/products');
            $request->photoVenta->move($destino, $nombre);
            $product->photoVenta = $nombre;
            $product->save();
        }
        return redirect('product')->with('mensaje', 'Producto creado con exito');
    }

    public function edit($id) {
        $product = Product::find($id);
        $category = Category::where('type', 3)->get();
        $layapa = Category::where('company_id', Auth::user()->company_id)->where('type', 4)->get();
        return view('product/edit')
                        ->with('product', $product)
                        ->with('layapa', $layapa)
                        ->with('category', $category);
    }

    public function update(Request $request, $id) {
//        dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->description_larga = $request->input('description_larga');
        $product->category_product_id = $request->input('cate_yapa');
        $product->unit_measure_id = $request->input('unidad_id');
        $product->unidad_name = Category::find($request->input('unidad_id'))->title;
        $product->tipo_iva = $request->input('tipo_iva');
        $product->costo = $request->input('costo');
        $product->precio_a = $request->input('precio_a');
        $product->precio_b = $request->input('precio_b');
        $product->precio_c = $request->input('precio_c');
        $product->tipo = $request->input('tipo');
        $product->stock = $request->input('stock_inicial');
        $product->stock_minimo = $request->input('stock_minimo');
        $product->save();
        if ($request->file('photo') !== null) {
            $imagen = $request->file('photo');
            if ($product->photo !== null) {
                $nombre = $product->photo;
                $borrar = public_path() . '/uploads/products/' . $product->photo;
                unlink($borrar);
            } else {
                $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            }
            $destino = public_path('uploads/products');
            $request->photo->move($destino, $nombre);
            $product->photo = $nombre;
            $product->save();
        }
        if ($request->file('photoVenta') !== null) {
            $imagen = $request->file('photoVenta');
            if ($product->photoVenta !== null) {
                $nombre = $product->photoVenta;
                $borrar = public_path() . '/uploads/products/' . $product->photoVenta;
                unlink($borrar);
            } else {
                $nombre = 'venta' . time() . '.' . $imagen->getClientOriginalExtension();
            }
            $destino = public_path('uploads/products');
            $request->photoVenta->move($destino, $nombre);
            $product->photoVenta = $nombre;
            $product->save();
        }
        return redirect('product')->with('mesaje', 'Producto Editado con Exito');
    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->status = false;
        $product->save();
        return redirect('product')
                        ->with('mensaje', 'Producto Eliminado Satisfactoriamente...');
    }

    public function saveCateLayapa(Request $request) {
        $datos = $request->input('parametros');
        $categoria = New Category();
        $categoria->company_id = Auth::user()->company_id;
        $categoria->title = strtoupper($datos['categoria']);
        $categoria->type = 4;
        $categoria->type_name = 'CATEGORIAS DE PRODUCTOS LAYAPA';
        $categoria->status = true;
        $categoria->save();
        $layapa = Category::where('company_id', Auth::user()->company_id)->where('type', 4)->get();
        return Response::json($layapa);
    }

}
