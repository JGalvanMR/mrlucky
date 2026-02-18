<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class PaginaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $path = resource_path() . "/views/site/pages/";
        $files = scandir($path);
        $paginas = [];
        $i = 1;

        foreach($files as $file){
            if(!in_array($file, ['.', '..'])){
                $paginas[$i]['nombre'] = ucfirst( str_replace(['.blade.php', '-'], ['', ' '], $file) );
                $paginas[$i]['archivo'] = $file;
                $i++;
            }
        }
        return view('admin.modules.paginas.index', compact('paginas'));
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($archivo){
        $path = resource_path() . "/views/site/pages/";
        $file = $archivo;
        $codigo = File::get($path.$file);

        //dd($codigo);
        return view('admin.modules.paginas.editar', compact('path', 'file', 'codigo'));
    }

    /*----------  Editar  ----------*/
    public function editar(Request $request){
        $path = resource_path() . "/views/site/pages/";
        $file = $request->archivo;

        $filename = $path.$file;

        if(File::isFile($filename)){

            if(!File::isWritable($filename)){
                chmod($filename, 0755);
            }

            $previewFile = fopen($filename, "w");
            fwrite($previewFile, $request->codigo);
            fclose($previewFile);

            return ['class' => 'success', 'titulo' => 'Página', 'msg' => 'El código ha sido guardado.'];
        }else{
            return ['class' => 'error', 'titulo' => 'Página', 'msg' => 'El archivo no fue encontrado.'];
        }

    }

}
