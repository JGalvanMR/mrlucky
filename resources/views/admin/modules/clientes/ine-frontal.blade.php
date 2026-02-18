@if($cliente->ine_frontal)
    <img src="/uploads/{{ $cliente->ine_frontal }}" class="img-fluid" loading="lazy" alt="">
    <div></div>
    <a href="#." class="btn btn-danger btn-xs btn-eliminar-ine-frontal">
    	<i class="fa fa-trash"></i> Eliminar
    </a>
@else
    <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarIneFrontal">
    	Agregar <i class="fa fa-plus-circle"></i>
    </a>
@endif

@section('modals')
	@parent

	{{-- Modal Agregar INE Frontal --}}
    <div class="modal fade" id="modalAgregarIneFrontal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Agregar INE Frontal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarIneFrontal" action="{{ route('clientes.agregar_ine_frontal') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                        <div class="form-group mb-2">
                            <label for="">INE Frontal</label>
                            <x-file-input name="ine_frontal" route="{{ route('uploads_subir') }}" folder="clientes/ine" filecount="1" scripts="0" />
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('partialsJS')
	@parent
	<script>
		$(function(){

			/*----------  Eliminar INE Frontal  ----------*/
			$('body').on('click','.btn-eliminar-ine-frontal',function(){
                let url = "{{ route('clientes.eliminar_ine_frontal') }}";

                swal({
                    title: "¿Desea eliminar la INE?",
                    text: "La información no podrá ser recuperada.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            cache: false,
                            type: 'post',
                            data:{
                            	cliente_id : {{ $cliente->id }}
                            },
                            dataType: 'json',
                            success: function(res){
                                swal({
                                    title: res.titulo,
                                    text: res.msg,
                                    type: res.class,
                                    onClose: function(){
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                });
                return false;
            });
		});
	</script>
	<x-ajax-form id="formAgregarIneFrontal" titulo="Agregar INE Frontal" reload="1" />
@stop


