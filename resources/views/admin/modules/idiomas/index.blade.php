@extends('admin.layouts.master')

@section('titulo', 'Listado de idiomas')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Idiomas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Idiomas</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('idiomas.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de idiomas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Nombre</th>
                                        <th>Clave</th>
                                        <th>Estatus</th>
                                        <th>Principal</th>
                                        <th>Orden</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($idiomas as $idioma)
                                        <tr>
                                            <td>{{ $idioma->nombre ?? '--' }}</td>
                                            <td>{{ $idioma->clave ?? '--' }}</td>
                                            <td>
                                                @if($idioma->activo)
                                                    <span class="label label-success">Activo</span>
                                                @else
                                                    <span class="label label-warning">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($idioma->principal)
                                                    <span class="label label-success">Sí</span>
                                                @else
                                                    <span class="label label-warning">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $idioma->orden ?? '--' }}</td>
                                            <td>
                                                <a href="{{ route('idiomas.editar', ['hash_id'=>Hashids::encode($idioma->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <x-btn-eliminar titulo="Eliminar idioma" url="{{ route('idiomas.eliminar', ['hash_id'=>Hashids::encode($idioma->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-data-tables />
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent

@stop