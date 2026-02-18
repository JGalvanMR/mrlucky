@extends('admin.layouts.master')

@section('titulo', 'Editar cliente')

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
                    <li class="breadcrumb-item"><a href="{{ route('clientes') }}">Clientes</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('clientes') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Cliente</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('clientes.editar', ['hash_id'=>Hashids::encode($cliente->id)]) }}" class="form-horizontal form-bordered m-t-40">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Nombre</label>
                                    <div class="col-md-7">
                                        <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" data-error="*El nombre es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Apellido paterno</label>
                                    <div class="col-md-7">
                                        <input type="text" name="apellido_paterno" class="form-control" value="{{ $cliente->apellido_paterno }}" data-error="*El apellido paterno es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Apellido materno</label>
                                    <div class="col-md-7">
                                        <input type="text" name="apellido_materno" class="form-control" value="{{ $cliente->apellido_materno }}" data-error="*El apellido materno es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Fecha de nacimiento</label>
                                    <div class="col-md-7">
                                        <x-date name="fecha_nacimiento" scripts="1" value="{{ $cliente->fecha_nacimiento }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">RFC</label>
                                    <div class="col-md-7">
                                        <input type="text" name="rfc" class="form-control" value="{{ $cliente->rfc }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">CURP</label>
                                    <div class="col-md-7">
                                        <input type="text" name="curp" class="form-control" value="{{ $cliente->curp }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Género</label>
                                    <div class="col-md-7">
                                        <select name="genero" class="form-control">
                                            <option value="h" {{ ($cliente->genero == 'h') ? 'selected' : '' }}>Hombre</option>
                                            <option value="m" {{ ($cliente->genero == 'm') ? 'selected' : '' }}>Mujer</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Correo</label>
                                    <div class="col-md-7">
                                        <input type="email" name="correo" class="form-control" value="{{ $cliente->correo }}" data-error="*Ingresa un correo válido." data-required-error="*Su correo es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Teléfono</label>
                                    <div class="col-md-7">
                                        <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Dirección</label>
                                    <div class="col-md-7">
                                        <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Colonia</label>
                                    <div class="col-md-7">
                                        <input type="text" name="colonia" class="form-control" value="{{ $cliente->colonia }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Código postal</label>
                                    <div class="col-md-7">
                                        <input type="text" name="codigo_postal" class="form-control" value="{{ $cliente->codigo_postal }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estado</label>
                                    <div class="col-md-7">
                                        <select id="estados" name="estado_id" class="form-control select2">
                                            <option value="">- Seleccione un estado -</option>
                                            @foreach($estados as $estado)
                                                <option value="{{ $estado->id }}" {{ ($estado->id == @$cliente->ciudad->estado_id) ? 'selected' : '' }}>{{ $estado->estado }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Ciudad</label>
                                    <div class="col-md-7">
                                        <select id="ciudades" name="ciudad_id" class="form-control select2">
                                            <option value="">- Seleccione una ciudad -</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="{{ $cliente->activo }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div> --}}
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
    {{-- <pre>
        {{ print_r($cliente->toArray()) }}
    </pre> --}}
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

            /*----------  Ciudades  ----------*/
            $('#estados').on('change', function(){
                $(".preloader").fadeIn();
                let estado = $(this).val();

                $.ajax({
                    url: "{{ route('api.ciudades', ["estado_id"=>null]) }}/" + estado,
                    cache: false,
                    dataType: 'json',
                    type: 'get',
                    success: function(ciudades){
                        let options = `<option value="">- Seleccione una ciudad -</option>`;
                        $.each(ciudades, function(key, ciudad){
                            if(ciudad.id == {{ (int)$cliente->ciudad_id }} ){
                                options += `<option value="${ciudad.id}" selected>${ciudad.ciudad}</option>`;
                            }else{
                                options += `<option value="${ciudad.id}">${ciudad.ciudad}</option>`;
                            }
                        });

                        $('#ciudades').html(options);
                        $(".preloader").fadeOut();
                    }
                });
            });
            $('#estados').change();
            
        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Cliente" reload="1" />
@stop