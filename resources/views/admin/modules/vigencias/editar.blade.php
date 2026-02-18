<a href="#." class="btn btn-primary btn-xs btn-editar">
    Editar <i class="fa fa-pencil-square-o"></i>
</a>


@section('modals')
    @parent
	<div class="modal fade" id="modalEditarVigencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white font-weight-bold">Editar vigencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarVigenciaForm" action="{{ route('vigencias.editar', ['hash_id'=>Hashids::encode($vigencia->id)]) }}" data-toggle="validator" data-disable="false" data-focus="false">
                        <div class="form-group">
                            <label for="">*Monto</label>
                            <input type="text" name="monto" class="form-control money" value="$ {{ number_format($vigencia->monto,2) }}" data-error="*El monto es requerido." required>
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">*Fecha de inicio</label>
                            <input type="text" name="fecha_inicio" class="form-control fecha" value="{{ $vigencia->fecha_inicio }}" data-error="*La fecha de inicio es requerida." required>
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">*Fecha de fin</label>
                            <input type="text" name="fecha_fin" class="form-control fecha" value="{{ $vigencia->fecha_fin }}" data-error="*La fecha de fin es requerida." required>
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">*Fecha de vencimiento</label>
                            <input type="text" name="fecha_vencimiento" class="form-control fecha" value="{{ $vigencia->fecha_vencimiento }}" data-error="*La fecha de vencimiento es requerida." required>
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">*Estatus</label>
                            <select name="estatus" class="form-control select2" data-error="*El estatus de pago es requerido." required>
                                <option value="">- Seleccione un método de pago -</option>
                                <option value="pen" {{ ($vigencia->estatus == 'pen') ? 'selected' : '' }}>Pendiente</option>
                                <option value="act" {{ ($vigencia->estatus == 'act') ? 'selected' : '' }}>Activa</option>
                                <option value="ven" {{ ($vigencia->estatus == 'ven') ? 'selected' : '' }}>Vencida</option>
                                <option value="can" {{ ($vigencia->estatus == 'can') ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('partialsCSS')
	@parent

@stop

@section('partialsJS')
	@parent

	<script>
		$(function(){

			/*----------  Btn Editar  ----------*/
            $('.btn-editar').on('click', function(){
                $("#modalEditarVigencia").modal('show');
                return false;
            });


		});
	</script>

	<x-ajax-form id="editarVigenciaForm" titulo="Editar vigencia" reload="1" />
@stop