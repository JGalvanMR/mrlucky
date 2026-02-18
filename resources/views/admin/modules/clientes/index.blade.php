@extends('admin.layouts.master')

@section('titulo', 'Listado de clientes')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Clientes</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('clientes.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de clientes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <table class="datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->nombre ?? '--' }}</td>
                                            <td>{{ $cliente->apellido_paterno ?? '--' }}</td>
                                            <td>{{ $cliente->apellido_materno ?? '--' }}</td>
                                            <td>{{ $cliente->correo ?? '--' }}</td>
                                            <td>{{ $cliente->telefono ?? '--' }}</td>
                                            <td>
                                                <a href="{{ route('clientes.ver', ['hash_id'=>Hashids::encode($cliente->id)]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Ver">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('clientes.editar', ['hash_id'=>Hashids::encode($cliente->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <x-btn-eliminar titulo="Eliminar cliente" url="{{ route('clientes.eliminar', ['hash_id'=>Hashids::encode($cliente->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}

                        </div>
                        <livewire:cliente-table />

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <x-data-tables /> --}}
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .btn-group label{ color: #000 !important; }
        [type="checkbox"]:not(:checked), [type="checkbox"]:checked { position: relative; opacity:1; left: 0; }

        th, td { white-space: nowrap; }
        .table td{ padding: .3rem; }
        .table th{ padding: .45rem; }
    </style>

@stop

@section('customJS')
    @parent

    <script>
        $(function(){

            $('body').magnificPopup({
                delegate: '.magnific',
                type: 'image'
            });

            Livewire.on('errorDelete', function(mensaje){

                swal({
                    title: "Eliminar cliente",
                    text: mensaje,
                    type: 'warning'
                });

            });

            Livewire.on('errorExport', function(mensaje){

                swal({
                    title: "Exportar clientes",
                    text: mensaje,
                    type: 'warning'
                });

            });
        });

        $("tbody tr").on('click', function(){
            $("tbody tr").removeClass('bg-primary text-white');
            $(this).addClass('bg-primary text-white');
        });
    </script>


@stop