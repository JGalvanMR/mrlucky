@extends('admin.layouts.master')

@section('titulo', 'Listado de proveedores')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Proveedores</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Proveedores</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('proveedores.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de proveedores</h4>
                    </div>
                    <div class="card-body">

                        <livewire:proveedor-table />

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

            /*----------  Error eliminado masivo  ----------*/
            Livewire.on('errorDeleteProveedor', function(mensaje){
                swal({
                    title: "Eliminar proveedor",
                    text: mensaje,
                    type: 'warning'
                });
            });

            /*----------  Eliminado masivo Exitoso  ----------*/
            Livewire.on('successDeleteProveedor', function(mensaje){
                swal({
                    title: "Eliminar proveedor",
                    text: mensaje,
                    type: 'success'
                });
            });

            Livewire.on('errorExportProveedor', function(mensaje){

                swal({
                    title: "Exportar proveedor",
                    text: mensaje,
                    type: 'warning'
                });

            });

            $("tbody tr").on('click', function(){
                $("tbody tr").removeClass('bg-primary text-white');
                $(this).addClass('bg-primary text-white');
            });
        });
    </script>


@stop