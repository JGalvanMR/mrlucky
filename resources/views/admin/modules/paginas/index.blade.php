@extends('admin.layouts.master')

@section('titulo', 'Listado de páginas')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Páginas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Páginas</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Listado de páginas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="listado table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Archivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paginas as $pagina)
                                        <tr>
                                            <td>{{ $pagina['nombre'] ?? '--' }}</td>
                                            <td>{{ $pagina['archivo'] ?? '--' }}</td>
                                            <td>
                                                <a href="{{ route('paginas.editar', ['archivo' => $pagina['archivo']]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar Código">
                                                    <i class="fa fa-code"></i>
                                                </a>
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


