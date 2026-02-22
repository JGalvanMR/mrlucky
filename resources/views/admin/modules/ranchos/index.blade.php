@extends('admin.layouts.master')

@section('titulo', 'Listado de ranchos')

@section('page')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Ranchos & Certificaciones</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Admin</a>
                </li>
                <li class="breadcrumb-item active">Ranchos</li>
            </ol>
        </div>
    </div>

    <div class="m-t-10 m-b-10 text-right">
        <a href="{{ route('ranchos.agregar_form') }}" class="btn btn-success btn-xs">
            Agregar <i class="fa fa-plus-circle"></i>
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-info">
                    <h4 class="m-b-0 text-white">Listado de ranchos</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Rancho</th>
                                    <th>Ubicación</th>
                                    <th>Imagen</th>
                                    <th>Estatus</th>
                                    <th>Certificaciones</th>
                                    <th>Orden</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ranchos->whereNull('deleted_at') as $rancho)
                                <tr>
                                    <td>{{ $rancho->nombre ?? '--' }}</td>

                                    <td>
                                        {{ $rancho->ubicacion ?? '--' }}
                                        @if($rancho->municipio)
                                        <br><small class="text-muted">{{ $rancho->municipio }}, {{ $rancho->estado }}</small>
                                        @endif
                                    </td>

                                    <td>
                                        @if($rancho->imagen)
                                        <img src="/uploads/{{ $rancho->imagen }}" class="img-fluid" loading="lazy" width="100" alt="">
                                        @else
                                        --
                                        @endif
                                    </td>

                                    <td>
                                        @if($rancho->activo)
                                        <span class="label label-success">Activo</span>
                                        @else
                                        <span class="label label-warning">Inactivo</span>
                                        @endif
                                    </td>

                                    <td>
                                        @forelse($rancho->certificacion as $cert)
                                        <div class="mb-1">
                                            {{-- Badge tipo --}}
                                            <span class="label"
                                                style="background:{{ $cert->tipoCertificacion->color_hex ?? '#777' }}; color:#fff;">
                                                {{ $cert->tipoCertificacion->nombre ?? 'N/A' }}
                                            </span>
                                            {{-- Estado vigencia --}}
                                            @if($cert->es_vigente && $cert->proximo_a_vencer)
                                            <span class="label label-warning">
                                                <i class="fa fa-clock-o"></i>
                                                Vence en {{ $cert->dias_para_vencer }} días
                                            </span>
                                            @elseif($cert->es_vigente)
                                            <span class="label label-success">
                                                <i class="fa fa-check-circle"></i> Vigente
                                            </span>
                                            @else
                                            <span class="label label-danger">
                                                <i class="fa fa-times-circle"></i> Vencido
                                            </span>
                                            @endif
                                            {{-- PDF --}}
                                            @if($cert->pdf_path)
                                            <a href="{{ route('certificaciones.descargar', $cert->id) }}"
                                                target="_blank"
                                                class="text-danger ml-1"
                                                title="Descargar PDF">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                            @endif
                                            <br>
                                            <small class="text-muted">
                                                hasta {{ $cert->fecha_vencimiento->format('d/m/Y') }}
                                            </small>
                                        </div>
                                        @empty
                                        <span class="text-muted small">Sin certificaciones</span>
                                        @endforelse
                                    </td>

                                    <td>{{ $rancho->orden ?? '--' }}</td>

                                    <td>
                                        <a href="{{ route('ranchos.editar', ['hash_id' => Hashids::encode($rancho->id)]) }}"
                                            class="btn btn-primary btn-xs"
                                            data-toggle="tooltip"
                                            title="Editar">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <x-btn-eliminar
                                            titulo="Eliminar Rancho"
                                            url="{{ route('ranchos.eliminar', ['hash_id' => Hashids::encode($rancho->id)]) }}"
                                            scripts="{{ $loop->first }}"
                                            btn="1" />
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

    {{-- Ranchos eliminados (soft delete) --}}
    @if($ranchos->whereNotNull('deleted_at')->isNotEmpty())
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background:#9e9e9e;">
                    <h4 class="m-b-0 text-white">
                        <i class="fa fa-trash mr-2"></i>
                        Ranchos eliminados ({{ $ranchos->whereNotNull('deleted_at')->count() }})
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="opacity:.7;">
                            <thead>
                                <tr>
                                    <th>Rancho</th>
                                    <th>Ubicación</th>
                                    <th>Eliminado el</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ranchos->whereNotNull('deleted_at') as $rancho)
                                <tr>
                                    <td><s>{{ $rancho->nombre }}</s></td>
                                    <td>{{ $rancho->ubicacion }}</td>
                                    <td>{{ $rancho->deleted_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

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
    $(function() {

    });
</script>
@stop
