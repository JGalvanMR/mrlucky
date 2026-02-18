@extends('admin.layouts.master')

@section('titulo', 'Editar Página')

@section('page')
    <div class="container-fluid" id="controls">
        <div class="m-b-10 text-right">
            <a href="{{ route('paginas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
            {{-- <a href="#." class="btn btn-primary btn-xs" onclick='fullscreen();'>
                <i class="fa  fa-arrows-alt"></i>
            </a> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('paginas.editar', ['archivo'=> $file]) }}" class="form-horizontal form-bordered">
                            <input type="hidden" name="archivo" value="{{ $file }}">
                            <div class="form-body">
                                <div class="form-group">
                                    <textarea name="codigo" class="codigo">{{ $codigo }}</textarea>
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        /*#controls{
            width:300px;
            height:100px;
            margin: auto auto auto auto;
        }*/
    </style>
@stop

@section('customJS')
    @parent
    <script src="/admin/assets/plugins/jquery-ace/ace/ace.js"></script>
    <script src="/admin/assets/plugins/jquery-ace/ace/theme-cobalt.js"></script>
    <script src="/admin/assets/plugins/jquery-ace/ace/mode-php.js"></script>
    <script src="/admin/assets/plugins/jquery-ace/jquery-ace.min.js"></script>

    <script>

            var isFullscreen = false;

            function fullscreen(){
                var d = {};
                var speed = 300;
                if(!isFullscreen){ // MAXIMIZATION
                    d.width = "100%";
                    d.height = "100%";
                    d.position = "absolute";
                    isFullscreen = true;
                }
                else{ // MINIMIZATION
                    d.width = "100%";
                    d.height = "500px";
                    d.position = "relative";
                    isFullscreen = false;
                }
                $("#controls").animate(d,speed);
            }

        $(function(){

           /*----------  Código  ----------*/
            $('.codigo').ace({
              theme: 'cobalt',
              lang: 'php',
              height: '500px',
              width: '100%'
            });
        });
    </script>

    <x-validator /> 
    <x-ajax-form id="editarForm" titulo="Editar Página" reload="1" />
@stop
