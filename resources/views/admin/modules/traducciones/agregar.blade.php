@extends('admin.layouts.master')

@section('titulo', 'Agregar Traducción')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Traducciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('traducciones') }}">Traducciones</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('traducciones') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar traducción</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('traducciones.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            {{-- <input type="hidden" name="grupo" value="web"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Grupo</label>
                                    <div class="col-md-7">
                                        <input type="text" name="grupo" class="form-control" data-error="*El grupo es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Clave</label>
                                    <div class="col-md-7">
                                        <input type="text" name="clave" class="form-control" data-error="*La clave es requerida." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Traducción</label>
                                    <div class="col-md-7">
                                        <div class="some-repeating-fields row mb-3" data-ac-repeater="traduccion" data-ac-repeater-text="Agregar traducción">
                                            <div class="col-3">
                                                <input name="idioma" class="form-control" placeholder="Idioma" value="">
                                            </div>
                                            <div class="col-9">
                                                <input name="texto" class="form-control" placeholder="Texto" value="">
                                            </div>
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                            Agregar
                                        </button>
                                    </div>
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

@stop

@section('customJS')
    @parent
    <x-validator />
    <script src="/admin/assets/plugins/ac-form-field-repeater.js/jquery.ac-form-field-repeater.js"></script>

    <script>
        $(function(){

            
        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Traducción" reload="1" />
@stop