<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Hashids;
use Auth;

class UserController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $usuarios = User::all();
        return view('admin.modules.usuarios.index', compact('usuarios'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        return view('admin.modules.usuarios.agregar');
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $usuario = new User;
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $usuario->create($data);

        return ['titulo'=>'Agregar usuario', 'msg'=>'El usuario ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $usuario = User::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.usuarios.editar', compact('usuario'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $usuario = User::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->password){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);
        return ['titulo'=>'Editar usuario', 'msg'=>'El usuario ha sido editado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $usuario = User::findOrFail(Hashids::decode($hash_id)[0]);
        $usuario->delete();

        return ['titulo'=>'Eliminar usuario', 'msg'=>'El usuario ha sido eliminado.', 'class'=>'success'];
    }
    
    /*----------  Login Form  ----------*/
    public function loginForm(){
        if(auth()->check()){
            return redirect(route('categorias_productos'));
        }
        return view('admin.modules.usuarios.login');
    }

    /*----------  Login  ----------*/
    public function login(Request $request){

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $res = ['titulo'=>'Iniciar sesión', 'msg'=>'Ha iniciado sesión como administrador.', 'class'=>'success'];
        }else{
            $res = ['titulo'=>'Iniciar sesión', 'msg'=>'Ha ocurrido un error, vuela a intentar.', 'class'=>'error'];
        }

        // if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
        //     $res = ['titulo'=>'Iniciar sesión', 'msg'=>'Ha iniciado sesión como administrador.', 'class'=>'success'];
        // }elseif(Auth::guard('entrenadores')->attempt(['email'=>$request->email, 'password'=>$request->password])){
        //     $res = ['titulo'=>'Iniciar sesión', 'msg'=>'Ha iniciado sesión como entrenador.', 'class'=>'success'];
        // }else{
        //     $res = ['titulo'=>'Iniciar sesión', 'msg'=>'Ha ocurrido un error, vuela a intentar.', 'class'=>'error'];
        // }

        return $res;

    }

    /*----------  Logout  ----------*/
    public function logout(){
        Auth::logout();
        //Auth::guard('entrenadores')->logout();
        return redirect(route('login'));
    }
}
