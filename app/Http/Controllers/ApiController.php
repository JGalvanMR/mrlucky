<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\CategoriaReceta;

class ApiController extends Controller
{

    /*----------  Listado de categorías  ----------*/
    public function getCategorias($idioma_id=null, Request $request){
        //dd($request);
        return CategoriaProducto::where('idioma_id', $idioma_id)->orderBy('orden', 'ASC')->get();
    }

    /*----------  Listado de productos  ----------*/
    public function getProductos($categoria_id=null, Request $request){
        //dd($request);
        return Producto::where('categoria_id', $categoria_id)->where('activo','1')->orderBy('orden', 'ASC')->get();
    }

    /*----------  Listado de categorías  ----------*/
    public function getCategoriasRecetas($idioma_id=null, Request $request){
        //dd($request);
        return CategoriaReceta::where('idioma_id', $idioma_id)->orderBy('orden', 'ASC')->get();
    }
}
