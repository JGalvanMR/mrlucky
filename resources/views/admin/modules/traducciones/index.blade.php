@extends('admin.layouts.master')

@section('titulo', 'Listado de traducciones')

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
                    <li class="breadcrumb-item active">Traducciones</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('traducciones.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de traducciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Clave</th>
                                    <th>Traducción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($traducciones as $traduccion)
                                    <tr>
                                        <td>{{ $traduccion->group }}</td>
                                        <td>{{ $traduccion->key  }}</td>
                                        <td style="max-width: 350px; white-space: normal;">
                                            @foreach($traduccion->text as $key => $value)
                                                <div>
                                                    <span class="badge badge-primary">{{ $key }}</span>
                                                    <div class="small">{{ $value }}</div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('traducciones.editar', ['hash_id' => Hashids::encode($traduccion->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <x-btn-eliminar titulo="Eliminar Traducción" url="{{ route('traducciones.eliminar', ['hash_id'=>Hashids::encode($traduccion->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
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