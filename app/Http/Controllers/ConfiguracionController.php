<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Str;
use EnvEditor;
use Artisan;

class ConfiguracionController extends Controller
{
    /*----------  Editar Form  ----------*/
    public function editarForm(){
        return view('admin.modules.configuraciones.editar');
    }

    /*----------  Editar  ----------*/
    public function editar(Request $request){
        $data = $request->all();

        EnvEditor::editKey('APP_NAME', '"'.$data['app_name'].'"'); 
        
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $config->set('logo', $request->logo);
        $config->set('logo_header', $request->logo_header);
        $config->set('portada', $request->portada);
        $config->set('favicon', $request->favicon);
        $config->set('colorPrincipal', $request->colorPrincipal);
        $config->set('colorSecundario', $request->colorSecundario);
        $config->set('colorEnlaces', $request->colorEnlaces);
        $config->set('copy', $request->copy);
        //$config->set('prefijo', $request->prefijo);
        $config->save();

        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return ['titulo'=>'Configuración', 'msg'=>'La configuración ha sido actualizada.', 'class'=>'success'];
    }

    /*----------  Subir Logo  ----------*/
    public function subirLogo(Request $request){

        //dd($request->file());

        $disk = Storage::disk('uploads');
        $file = $request->file('logoInput');

        $folder = "configuraciones/";
        $filename = $folder . time() . "-" . Str::slug($file->getClientOriginalName(), '-') .'.'.$file->getClientOriginalExtension();

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $disk->put($filename, File::get($file) );

        $res = ["imagen" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Logo ----------*/
    public function eliminarLogo(Request $request){

        $disk = Storage::disk('uploads');
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $disk->delete($config->get('logo'));
        $config->set('logo', null);
        $config->save();

        return '{}';
    }

    /*----------  Subir Logo Header  ----------*/
    public function subirLogoHeader(Request $request){

        //dd($request->file());

        $disk = Storage::disk('uploads');
        $file = $request->file('logo_headerInput');

        $folder = "configuraciones/";
        $filename = $folder . time() . "-" . Str::slug($file->getClientOriginalName(), '-') .'.'.$file->getClientOriginalExtension();

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $disk->put($filename, File::get($file) );

        $res = ["imagen" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Logo Header ----------*/
    public function eliminarLogoHeader(Request $request){

        $disk = Storage::disk('uploads');
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $disk->delete($config->get('logo_header'));
        $config->set('logo_header', null);
        $config->save();

        return '{}';
    }

    /*----------  Subir Portada  ----------*/
    public function subirPortada(Request $request){

        //dd($request->file());

        $disk = Storage::disk('uploads');
        $file = $request->file('portadaInput');

        $folder = "configuraciones/";
        $filename = $folder . time() . "-" . Str::slug($file->getClientOriginalName(), '-') .'.'.$file->getClientOriginalExtension();

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $disk->put($filename, File::get($file) );

        $res = ["imagen" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Portada ----------*/
    public function eliminarPortada(Request $request){

        $disk = Storage::disk('uploads');
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $disk->delete($config->get('portada'));
        $config->set('portada', null);
        $config->save();

        return '{}';
    }

    /*----------  Subir Favicon  ----------*/
    public function subirFavicon(Request $request){

        //dd($request->file());

        $disk = Storage::disk('uploads');
        $file = $request->file('faviconInput');

        $folder = "configuraciones/";
        $filename = $folder . time() . "-" . Str::slug($file->getClientOriginalName(), '-') .'.'.$file->getClientOriginalExtension();

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $disk->put($filename, File::get($file) );

        $res = ["imagen" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Favicon ----------*/
    public function eliminarFavicon(Request $request){

        $disk = Storage::disk('uploads');
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $disk->delete($config->get('favicon'));
        $config->set('favicon', null);
        $config->save();

        return '{}';
    }
}
