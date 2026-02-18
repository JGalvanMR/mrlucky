@extends('admin.layouts.master')

@section('titulo', 'Agregar póliza')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Pólizas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('polizas') }}">Pólizas</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('polizas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Póliza</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('polizas.agregar') }}" class="form-horizontal form-bordered m-t-40" data-focus="false" data-disable="false">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Cliente</label>
                                    <div class="col-md-7">
                                        <select name="cliente_id" class="form-control select2" data-error="*El cliente es requerido." required>
                                            <option value="">- Seleccione un cliente -</option>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tipo de cliente</label>
                                    <div class="col-md-7">
                                        <select name="tipo_cliente" class="form-control">
                                            <option value="1">Nuevo</option>
                                            <option value="2">Renovación</option>
                                            <option value="3">Preferente</option>
                                            <option value="4">VIP</option>
                                            <option value="5">Pendiente</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Inicio vigencia</label>
                                    <div class="col-md-7">
                                        <x-date name="vigencia_inicio" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fin vigencia</label>
                                    <div class="col-md-7">
                                        <x-date name="vigencia_fin" value="{{ date('Y') + 1 . date('-m-d') }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Marca</label>
                                    <div class="col-md-7">
                                        <select id="marcas" name="marca_id" class="form-control select2" data-error="*La marca es requerida." required>
                                            <option value="">- Seleccione una marca -</option>
                                            @foreach($marcas as $marca)
                                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Tipo</label>
                                    <div class="col-md-7">
                                        <select id="tipos" name="tipo_id" class="form-control select2" data-error="*El tipo es requerido." required>
                                            <option value="">- Seleccione un tipo -</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Modelo</label>
                                    <div class="col-md-7">
                                        <input type="text" name="modelo" class="form-control ano" value="{{ date('Y') }}" data-error="*El modelo es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Color</label>
                                    <div class="col-md-7">
                                        <input type="text" name="color" class="form-control" data-error="*El color es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Placas</label>
                                    <div class="col-md-7">
                                        <input type="text" name="placas" class="form-control" data-error="*Las placas son requeridas." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Número de motor</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_motor" class="form-control" data-error="*El número de motor es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Número de serie</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_serie" class="form-control" data-error="*El número de serie es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Cobertura</label>
                                    <div class="col-md-7">
                                        <select name="cobertura" class="form-control select2" data-error="*El tipo de cobertura es requerido." required>
                                            <option value="">- Seleccione el tipo de póliza -</option>
                                            <option value="1">Cobertura Amplia</option>
                                            <option value="2">Cobertura Intermedia</option>
                                            <option value="3">Cobertura Terceros Tipo A</option>
                                            <option value="4">Cobertura Terceros Tipo B</option>
                                            <option value="5">Cobertura Terceros Tipo C</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Capacidad</label>
                                    <div class="col-md-7">
                                        <select name="capacidad" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tipo</label>
                                    <div class="col-md-7">
                                        <select name="tipo" class="form-control select2">
                                            <option value="men">Mensual</option>
                                            <option value="tri">Trimestral</option>
                                            <option value="sem">Semestral</option>
                                            <option value="anu">Anual</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
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
    <x-select2 />
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent
    <x-validator />
    

    <script>
        $(function(){

            /*----------  Modelo  ----------*/
            $(".ano").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });

            /*----------  Tipos  ----------*/
            $('#marcas').on('change', function(){
                $(".preloader").fadeIn();
                let marca = $(this).val();

                $.ajax({
                    url: "{{ route('api.tipos', ["marca_id"=>null]) }}/" + marca,
                    cache: false,
                    dataType: 'json',
                    type: 'get',
                    success: function(tipos){
                        let options = `<option value="">- Seleccione un tipo -</option>`;
                        $.each(tipos, function(key, tipo){
                            options += `<option value="${tipo.id}">${tipo.nombre}</option>`;
                        });

                        $('#tipos').html(options);
                        $(".preloader").fadeOut();
                    }
                });
            });
            
        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Póliza" reload="1" />
@stop