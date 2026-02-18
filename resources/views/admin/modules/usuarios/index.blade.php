@extends('admin.layouts.master')

@section('titulo', 'Listado de usuarios')

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
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('usuarios.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de usuarios</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="listado table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->name ?? '--' }}</td>
                                            <td>{{ $usuario->email ?? '--' }}</td>
                                            <td>
                                                <a href="{{ route('usuarios.editar_form', ['hash_id'=>Hashids::encode($usuario->id)]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <x-btn-eliminar url="{{ route('usuarios.eliminar', ['hash_id'=>null]) }}" id="{{ Hashids::encode($usuario->id) }}" titulo="¿Desea eliminar el usuario?" scripts="{{ $loop->first }}" />
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
    {{-- <pre>
        {{ print_r($marcas->toArray()) }}
    </pre> --}}
    <x-data-tables />
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent
    <script>
        $('.listado tbody tr').on('click', function(){
            $('.listado tbody tr').removeClass('bg-info text-white');
            $(this).toggleClass('bg-info text-white');
        });
    </script>
@stop


