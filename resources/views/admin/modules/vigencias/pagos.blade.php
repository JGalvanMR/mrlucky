<a href="#." class="btn btn-success btn-xs btn-agregar-pago">
    Agregar pago <i class="fa fa-plus-circle"></i>
</a>


@section('modals')
    @parent
	<div class="modal fade" id="modalAgregarPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white font-weight-bold">Agregar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agregarPagoForm" action="{{ route('pagos.agregar') }}" data-toggle="validator" data-disable="false" data-focus="false">
                        <input type="hidden" name="vigencia_id" value="{{ $vigencia->id }}">
                        <div class="form-group">
                            <label for="">*Monto</label>
                            {{-- <input type="text" name="monto" class="form-control money" value="${{ number_format($vigencia->monto,2) }}" data-error="*El monto es requerido." required> --}}
                            <x-money name="monto" value="${{ number_format($vigencia->monto,2) }}" requerido="1" requeridoText="*El monto es requerido." />
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">*Fecha</label>
                            <x-date name="fecha_pago" requerido="1" requeridoText="*La fecha es requerida." />
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">*Método de pago</label>
                            <select name="metodo_pago" class="form-control select2">
                                <option value="efe">Efectivo</option>
                                <option value="dep">Depósito</option>
                                <option value="tra">Transferencia</option>
                                <option value="tar">Tarjeta de Débito/Crédito</option>
                            </select>
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Comentario</label>
                            <x-summer-note name="comentario" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button>
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

			/*----------  Btn Agregar Pago  ----------*/
            $('.btn-agregar-pago').on('click', function(){
                console.log('Agregar pago modal');
                $("#modalAgregarPago").modal('show');
                return false;
            });


		});
	</script>

	<x-ajax-form id="agregarPagoForm" titulo="Agregar Pago" reload="1" />
@stop