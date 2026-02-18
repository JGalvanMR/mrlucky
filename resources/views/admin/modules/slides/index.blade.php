@extends('admin.layouts.master')

@section('titulo', 'Listado de slides')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Slides</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Slides</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('slides.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de slides</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Imagen</th>
                                        <th>Imagen Móvil</th>
                                        <th>Enlace</th>
                                        <th>Estatus</th>
                                        {{-- <th>Orden</th> --}}
                                        <th>Abrir en</th>
                                        <th>Idioma</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slides as $slide)
                                        <tr>
                                            {{-- <td>{{ $slide->id }}</td> --}}
                                            <td>
                                                @if($slide->imagen)
                                                    <img src="/uploads/{{ $slide->imagen }}" class="img-fluid" width="140" alt="">
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if($slide->imagen_movil)
                                                    <img src="/uploads/{{ $slide->imagen_movil }}" class="img-fluid" width="140" alt="">
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>{{ $slide->enlace ?? '--' }}</td>
                                            <td>
                                                @if($slide->activo)
                                                    <span class="label label-success">Activo</span>
                                                @else
                                                    <span class="label label-warning">Inactivo</span>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $slide->orden }}</td> --}}
                                            <td>
                                                @if($slide->target_blank)
                                                    Otra pestaña
                                                @else
                                                    Misma pestaña
                                                @endif
                                            </td>
                                            <td>{{ $slide->idioma->nombre ?? '--' }}</td>
                                            <td>
                                                <a href="{{ route('slides.editar', ['hash_id'=>Hashids::encode($slide->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <x-btn-eliminar titulo="Eliminar slide" url="{{ route('slides.eliminar', ['hash_id'=>Hashids::encode($slide->id)]) }}" scripts="1" btn="1" />
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