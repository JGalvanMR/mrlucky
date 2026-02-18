<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Str;

class UploadController extends Controller
{
    /*----------  Subir Archivo  ----------*/
    public function subir(Request $request){
        $disk = Storage::disk('uploads');

        $folder = $request->folder.'/';
        $filename = $folder . time() . "-" . $_FILES[$request->name.'Input']['name'];

        //dd($request->all());

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $file = $request->file($request->name.'Input');
        $disk->put($filename, File::get($file) );

        $res = [$request->name => $filename];

        echo json_encode($res);
    }
}
