@extends('admin.layouts.master')

@section('titulo', 'Agregar Proveedor')

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
                    <li class="breadcrumb-item"><a href="{{ route('proveedores') }}">Proveedores</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('proveedores') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Proveedor</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('proveedores.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Tipo</label>
                                    <div class="col-md-7">
                                        <select name="tipo" class="form-control select2" data-error="*El tipo de proveedor es requerido." required>
                                            <option value="">- Seleccione un tipo -</option>
                                            <option value="tal">Taller</option>
                                            <option value="ref">Refaccionaria</option>
                                            <option value="gru">Grúa</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*RFC</label>
                                    <div class="col-md-7">
                                        <input type="text" name="rfc" class="form-control" data-error="*El RFC es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Razón Social</label>
                                    <div class="col-md-7">
                                        <input type="text" name="razon_social" class="form-control" data-error="*La razón social es requerida." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Alias</label>
                                    <div class="col-md-7">
                                        <input type="text" name="alias" class="form-control">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estado</label>
                                    <div class="col-md-7">
                                        <select id="estados" name="estado_id" class="form-control select2">
                                            <option value="">- Seleccione un estado -</option>
                                            @foreach($estados as $estado)
                                                <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
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
                            options += `<option value="${ciudad.id}">${ciudad.ciudad}</option>`;
                        });

                        $('#ciudades').html(options);
                        $(".preloader").fadeOut();
                    }
                });
            });
            
        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Proveedor" reload="1" />
@stop