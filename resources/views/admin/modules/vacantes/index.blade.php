@extends('admin.layouts.master')

@section('titulo', 'Listado de vacantes')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Vacantes</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Vacantes</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('vacantes.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de vacantes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Slug</th>
                                        <th>Imagen</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vacantes as $vacante)
                                        <tr>
                                            <td>{{ $vacante->titulo ?? '--' }}</td>
                                            <td>{{ $vacante->slug ?? '--' }}</td>
                                            <td>
                                                @if($vacante->imagen != '')
                                                    <img src="/uploads/{{ $vacante->imagen }}" class="img-fluid" loading="lazy" width="120" alt="">
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if($vacante->activo == '1')
                                                    <span class="label label-success">Activo</span>
                                                @else
                                                    <span class="label label-warning">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('vacantes.ver', ['hash_id'=>Hashids::encode($vacante->id)]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Ver">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('vacantes.editar', ['hash_id'=>Hashids::encode($vacante->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <x-btn-eliminar titulo="Eliminar Vacante" url="{{ route('vacantes.eliminar', ['hash_id'=>Hashids::encode($vacante->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
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

    <script>
        $(function(){

        });
    </script>


@stop