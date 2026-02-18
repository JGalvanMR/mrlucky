@if($siniestro->estatus == 'pro')
    <a href="#." id="btnConcluir" class="btn btn-inverse btn-xs" data-toggle="modal" data-target="#modalConcluirSiniestro">
        Concluir siniestro <i class="fa fa-thumbs-up"></i>
    </a>
@endif


@section('modals')
	@parent

	{{-- Modal Concluir Siniestro --}}
    <div class="modal fade" id="modalConcluirSiniestro" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Concluir Siniestro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="concluirSiniestroForm" action="{{ route('siniestros.concluir', ['hash_id'=>Hashids::encode($siniestro->id)]) }}" class="form-horizontal form-bordered" data-disable="false" data-focus="false">
                        <div class="form-body">

                            <div class="row">
                                <div class="form-group  col-12 col-md-4">
                                    <label class="control-label text-left">*Hora arribo</label>
                                    <div class="input-group clockpicker">
                                        <input type="text" name="hora_arribo" value="{{ $siniestro->hora_arribo }}" class="form-control hora" data-error="*La hora de arribo es requerida." required> <span class="input-group-addon"> <span class="fa fa-clock-o"></span></span>
                                    </div>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label class="control-label text-left">*Hora retiro</label>
                                    <div class="input-group clockpicker">
                                        <input type="text" name="hora_retiro" value="{{ $siniestro->hora_retiro }}" class="form-control hora" data-error="*La hora de retiro es requerida." required> <span class="input-group-addon"> <span class="fa fa-clock-o"></span></span>
                                    </div>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="">Calidad del asegurado</label>
                                    <select name="calidad_asegurado" class="form-control select2" data-error="*La calidad del asegurado es requerida." required>
                                        <option value="">- Seleccionar calidad del asegurado -</option>
                                        <option value="afe">Afectado</option>
                                        <option value="res">Responsable</option>
                                        <option value="ofi">Pasar a oficina</option>
                                        <option value="con">Consignado</option>
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="">*Lugar de arribo</label>
                                    <input type="text" name="lugar_arribo" class="form-control" data-error="*Ingrese el lugar de arribo." required>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="">*No. pase atención en taller</label>
                                    <input type="text" name="pase_taller" class="form-control" data-error="*Ingrese el pase de atención en taller." required>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="">No. pase atención médica</label>
                                    <input type="text" name="pase_medico" class="form-control">
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="">Servicio de grúa</label>
                                    <select name="servicio_grua" class="form-control select2">
                                        <option value="noa">NA</option>
                                        <option value="loc">Local</option>
                                        <option value="for">Foráneo</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="">Acuerdo en crucero</label>
                                    <div class="clearfix"></div>
                                    <x-bootstrap-toggle name="acuerdo_crucero" onText="Sí" offText="No" value="1" />
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="">Taller</label>
                                    <select name="taller_id" class="form-control select2">
                                        <option value="">- Seleccione un proveedor -</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->alias }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="control-label text-left">Declaración de asegurado</label>
                                    <div class="">
                                        <x-summer-note name="declaracion_asegurado" scripts="1" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="control-label text-left">Declaración de tercero</label>
                                    <div class="">
                                        <x-summer-note name="declaracion_tercero" scripts="0" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="control-label text-left">Observaciones de ajustador</label>
                                    <div class="">
                                        <x-summer-note name="observaciones_ajustador" scripts="0" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                        Concluir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('partialsCSS')
	@parent
	
	{{-- Datepicker --}}
    <link rel="stylesheet" href="/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">
	{{-- Clockpicker --}}
    <link href="/admin/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <style>
    	.clockpicker-popover{
    		z-index:9999;
    	}
    </style>
@stop

@section('partialsJS')
	@parent

	{{-- Datepicker --}}
    <script src="/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/locales/bootstrap-datepicker.es.min.js"></script>
	{{-- Clockpicker --}}
    <script src="/admin/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>

	<script>
		$(function(){

			/*----------  Hora  ----------*/
            $('.hora').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true,
                'default': 'now'
            });

		});
	</script>
    <x-ajax-form id="concluirSiniestroForm" titulo="Concluir Siniestro" reload="1" />
@stop