<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use App\Models\Idioma;
use Hashids;

class CategoriaRecetaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $categorias = CategoriaReceta::all();
        return view('admin.modules.categorias-recetas.index', compact('categorias'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        return view('admin.modules.categorias-recetas.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $categoria = new CategoriaReceta;
        $data = $request->all();
        $categoria->create($data);

        return ['titulo'=>'Agregar Categoría', 'msg'=>'La categoría ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        $categoria = CategoriaReceta::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.categorias-recetas.editar', compact('idiomas', 'categoria'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $categoria = CategoriaReceta::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        if(!$request->activo)
            $data['activo'] = '0';
        $categoria->update($data);

        return ['titulo'=>'Editar Categoría', 'msg'=>'La categoría ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $categoria = CategoriaReceta::findOrFail(Hashids::decode($hash_id)[0]);
        $categoria->delete();

        return ['titulo'=>'Eliminar Categoría', 'msg'=>'La categoría ha sido eliminada.', 'class'=>'success'];

    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm($idioma_id=null){

        if($idioma_id){
            $categorias = CategoriaReceta::where('idioma_id', $idioma_id)->orderBy('orden', 'ASC')->get();
        }else{
            $categorias = CategoriaReceta::orderBy('orden', 'ASC')->get();
        }

        $idiomas = Idioma::all();
        return view('admin.modules.categorias-recetas.ordenar', compact('categorias', 'idiomas'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $categorias = $request->categorias;

        foreach ($categorias as $key => $categoria_id) {
            $categoria = CategoriaReceta::findOrFail($categoria_id);
            $categoria->orden = $key + 1;
            $categoria->save();
        }

        return ['titulo' => 'Ordenar Categorías', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }
}
