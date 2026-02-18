<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Idioma;
use Hashids;

class IngredienteController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $ingredientes = Ingrediente::all();
        return view('admin.modules.ingredientes.index', compact('ingredientes'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        return view('admin.modules.ingredientes.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $ingrediente = new Ingrediente;
        $data = $request->all();
        $ingrediente->create($data);

        return ['titulo'=>'Agregar Ingrediente', 'msg'=>'El ingrediente ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Agregar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        $ingrediente = Ingrediente::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.ingredientes.editar', compact('idiomas', 'ingrediente'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $ingrediente = Ingrediente::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        $ingrediente->update($data);

        return ['titulo'=>'Editar Ingrediente', 'msg'=>'El ingrediente ha sido editado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $ingrediente = Ingrediente::findOrFail(Hashids::decode($hash_id)[0]);
        $ingrediente->delete();
        return ['titulo'=>'Eliminar Ingrediente', 'msg'=>'El ingrediente ha sido eliminado.', 'class'=>'success'];
    }
}
