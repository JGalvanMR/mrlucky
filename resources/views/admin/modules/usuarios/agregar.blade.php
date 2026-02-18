@extends('admin.layouts.master')

@section('titulo', 'Agregar usuario')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Usuarios</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('usuarios') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar usuario</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('usuarios.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Nombre</label>
                                    <div class="col-md-7">
                                        <input type="text" name="name" class="form-control" data-error="*El nombre es requerido." required>
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Correo</label>
                                    <div class="col-md-7">
                                        <input type="email" name="email" class="form-control" data-error="*Ingrese un correo válido." data-required-error="*El correo es requerido." required>
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Contraseña</label>
                                    <div class="col-md-7">
                                        <input type="password" name="password" class="form-control" data-error="*La contraseña es requerida." required>
                                        <small class="help-block with-errors text-danger"></small>
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

    <script>
        $(function(){
            
        });
    </script>

    <x-validator /> 
    <x-ajax-form id="agregarForm" titulo="Agregar usuario" reload="1" />
@stop
