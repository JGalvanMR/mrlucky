<a href="#." class="btn btn-xs btn-primary btn-editar-pago" data-toggle="tooltip" title="Editar pago"
    data-pago="{{ $pago->id }}"
    data-monto="${{ number_format($pago->monto,2) }}"
    data-fecha-pago="{{ $pago->fecha_pago }}"
    data-metodo-pago="{{ $pago->metodo_pago }}"
    data-estatus="{{ $pago->estatus }}"
    data-comprobante="{{ $pago->comprobante }}"
    data-comentario="{{ $pago->comentario }}"
    data-action="{{ route('pagos.editar', ['hash_id'=>Hashids::encode($pago->id)]) }}">
    <i class="fa fa-pencil-square-o"></i>
</a>

@if($loop->first)
    @section('modals')
        @parent
    	<div class="modal fade" id="modalEditarPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold">Editar Pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editarPagoForm" action="" data-toggle="validator" data-disable="false" data-focus="false">
                            <div class="form-group">
                                <label for="">*Monto</label>
                                {{-- <input type="text" name="monto" class="form-control money" value="" data-error="*El monto es requerido." required> --}}
                                <x-money name="monto" requerido="1" requeridoText="*El monto es requerido." />
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="">*Fecha</label>
                                <x-date name="fecha_pago" requerido="1" requeridoText="*La fecha es requerida." />
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="">*Método de pago</label>
                                <select id="metodo_pago" name="metodo_pago" class="form-control select2">
                                    <option value="efe">Efectivo</option>
                                    <option value="dep">Depósito</option>
                                    <option value="tra">Transferencia</option>
                                    <option value="tar">Tarjeta de Débito/Crédito</option>
                                </select>
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="">Estatus</label>
                                <select id="estatus" name="estatus" class="form-control select2">
                                    <option value="pen">Pendiente</option>
                                    <option value="con">Confirmado</option>
                                    <option value="can">Cancelado</option>
                                </select>
                                <small class="help-block with-errors text-danger"></small>
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="">Comentario</label>
                                <x-summer-note name="comentario" />
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

    			/*----------  Btn Editar Pago  ----------*/
                $('.btn-editar-pago').on('click', function(){
                    let metodo_pago = $(this).data('metodo-pago');
                    let estatus = $(this).data('estatus');

                    console.log(metodo_pago);
                    
                    $('#editarPagoForm input[name=monto]').val($(this).data('monto'));
                    $('#editarPagoForm input[name=fecha_pago]').val($(this).data('fecha-pago'));
                    $('#metodo_pago').val(metodo_pago);
                    $('#metodo_pago').change();
                    $('#estatus').val(estatus);
                    $('#estatus').change();
                    $('#editarPagoForm input[name=fecha_pago]').val($(this).data('fecha-pago'));
                    $('#editarPagoForm textarea[name=comentario]').summernote('code', $(this).data('comentario'));
                    $('#editarPagoForm').attr('action', $(this).data('action') );

                    $("#modalEditarPago").modal('show');
                    return false;
                });


    		}); 
    	</script>

    	<x-ajax-form id="editarPagoForm" titulo="Editar Pago" reload="1" />
    @stop
@endif