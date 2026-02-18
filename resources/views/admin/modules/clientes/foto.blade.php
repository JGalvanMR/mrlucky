@if($cliente->foto)
    <img src="/uploads/{{ $cliente->foto }}" class="img-fluid" loading="lazy" alt="">
    <div></div>
    <a href="#." class="btn btn-danger btn-xs btn-eliminar-foto">
    	<i class="fa fa-trash"></i> Eliminar
    </a>
@else
    <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarFoto">
    	Agregar <i class="fa fa-plus-circle"></i>
    </a>
@endif

@section('modals')
	@parent

	{{-- Modal Agregar Foto --}}
    <div class="modal fade" id="modalAgregarFoto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Agregar Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarFoto" action="{{ route('clientes.agregar_foto') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                        <div class="form-group mb-2">
                            <label for="">Foto</label>
                            <x-file-input name="foto" route="{{ route('uploads_subir') }}" folder="clientes/fotos" filecount="1" />
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

			/*----------  Eliminar foto  ----------*/
			$('body').on('click','.btn-eliminar-foto',function(){
                let url = "{{ route('clientes.eliminar_foto') }}";

                swal({
                    title: "¿Desea eliminar la foto?",
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
	<x-ajax-form id="formAgregarFoto" titulo="Agregar Foto" reload="1" />
@stop


