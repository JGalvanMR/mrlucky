@extends('admin.layouts.master')

@section('titulo', 'Editar póliza')

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
                    <li class="breadcrumb-item active">Editar</li>
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
                        <h4 class="m-b-0 text-white">Editar Póliza</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('polizas.editar', ['hash_id'=>Hashids::encode($poliza->id)]) }}" class="form-horizontal form-bordered m-t-40" data-focus="false" data-disable="false">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Núm. Póliza</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_poliza" class="form-control" value="{{ $poliza->num_poliza }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Cliente</label>
                                    <div class="col-md-7">
                                        <select name="cliente_id" class="form-control select2" data-error="*El cliente es requerido." required>
                                            <option value="">- Seleccione un cliente -</option>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->id }}" {{ ($cliente->id == $poliza->cliente_id) ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tipo de cliente</label>
                                    <div class="col-md-7">
                                        <select name="tipo_cliente" class="form-control">
                                            <option value="1" {{ ($poliza->tipo_cliente == '1') ? 'selected' : '' }}>Nuevo</option>
                                            <option value="2" {{ ($poliza->tipo_cliente == '2') ? 'selected' : '' }}>Renovación</option>
                                            <option value="3" {{ ($poliza->tipo_cliente == '3') ? 'selected' : '' }}>Preferente</option>
                                            <option value="4" {{ ($poliza->tipo_cliente == '4') ? 'selected' : '' }}>VIP</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Inicio vigencia</label>
                                    <div class="col-md-7">
                                        <x-date name="vigencia_inicio" value="{{ $poliza->vigencia_inicio }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fin vigencia</label>
                                    <div class="col-md-7">
                                        <x-date name="vigencia_fin" value="{{ $poliza->vigencia_fin }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Marca</label>
                                    <div class="col-md-7">
                                        <select id="marcas" name="marca_id" class="form-control select2" data-error="*La marca es requerida." required>
                                            <option value="">- Seleccione una marca -</option>
                                            @foreach($marcas as $marca)
                                                <option value="{{ $marca->id }}" {{ ($marca->id == $poliza->submarca->marca_id) ? 'selected' : '' }}>{{ $marca->nombre }}</option>
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
                                        <input type="text" name="color" class="form-control" value="{{ $poliza->color }}" data-error="*El color es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Placas</label>
                                    <div class="col-md-7">
                                        <input type="text" name="placas" class="form-control" value="{{ $poliza->placas }}" data-error="*Las placas son requeridas." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Número de motor</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_motor" class="form-control" value="{{ $poliza->num_motor }}" data-error="*El número de motor es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Número de serie</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_serie" class="form-control" value="{{ $poliza->num_serie }}" data-error="*El número de serie es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Cobertura</label>
                                    <div class="col-md-7">
                                        <select name="cobertura" class="form-control select2" data-error="*El tipo de cobertura es requerido." required>
                                            <option value="">- Seleccione el tipo de póliza -</option>
                                            <option value="1" {{ ($poliza->cobertura == '1') ? 'selected' : '' }}>Cobertura Amplia</option>
                                            <option value="2" {{ ($poliza->cobertura == '2') ? 'selected' : '' }}>Cobertura Intermedia</option>
                                            <option value="3" {{ ($poliza->cobertura == '3') ? 'selected' : '' }}>Cobertura Terceros Tipo A</option>
                                            <option value="4" {{ ($poliza->cobertura == '4') ? 'selected' : '' }}>Cobertura Terceros Tipo B</option>
                                            <option value="5" {{ ($poliza->cobertura == '5') ? 'selected' : '' }}>Cobertura Terceros Tipo C</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Capacidad</label>
                                    <div class="col-md-7">
                                        <select name="capacidad" class="form-control">
                                            <option value="1" {{ ($poliza->capacidad == '1') ? 'selected' : '' }} >1</option>
                                            <option value="2" {{ ($poliza->capacidad == '2') ? 'selected' : '' }} >2</option>
                                            <option value="3" {{ ($poliza->capacidad == '3') ? 'selected' : '' }} >3</option>
                                            <option value="4" {{ ($poliza->capacidad == '4') ? 'selected' : '' }} >4</option>
                                            <option value="5" {{ ($poliza->capacidad == '5') ? 'selected' : '' }} >5</option>
                                            <option value="5" {{ ($poliza->capacidad == '6') ? 'selected' : '' }} >6</option>
                                            <option value="5" {{ ($poliza->capacidad == '7') ? 'selected' : '' }} >7</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tipo</label>
                                    <div class="col-md-7">
                                        <select name="tipo" class="form-control select2">
                                            <option value="men" {{ ($poliza->tipo == 'men') ? 'selected' : '' }}>Mensual</option>
                                            <option value="tri" {{ ($poliza->tipo == 'tri') ? 'selected' : '' }}>Trimestral</option>
                                            <option value="sem" {{ ($poliza->tipo == 'sem') ? 'selected' : '' }}>Semestral</option>
                                            <option value="anu" {{ ($poliza->tipo == 'anu') ? 'selected' : '' }}>Anual</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                            Guardar
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
                            if(tipo.id == {{ @$poliza->tipo_id }}){
                                options += `<option value="${tipo.id}" selected>${tipo.nombre}</option>`;
                            }else{
                                options += `<option value="${tipo.id}">${tipo.nombre}</option>`;
                            }
                        });

                        $('#tipos').html(options);
                        $(".preloader").fadeOut();
                    }
                });
            });
            $('#marcas').change();
            
        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Póliza" reload="1" />
@stop