@if($chofer->ine_frontal)
    <img src="/uploads/{{ $chofer->ine_frontal }}" class="img-fluid" loading="lazy" alt="">
    <div></div>
    <a href="#." class="btn btn-danger btn-xs btn-eliminar-ine-frontal" data-id="{{ $chofer->id }}">
    	<i class="fa fa-trash"></i> Eliminar
    </a>
@else
    <a href="#." class="btn btn-success btn-xs btn-agregar-ine-frontal" data-toggle="modal" data-target="#modalAgregarIneFrontal" data-id="{{ $chofer->id }}">
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
                    <form id="formAgregarIneFrontal" action="{{ route('choferes.agregar_ine_frontal') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="chofer_id" value="">
                        <div class="form-group mb-2">
                            <label for="">INE Frontal</label>
                            {{-- <x-file-input name="ine_frontal" route="{{ route('uploads_subir') }}" folder="choferes/ine" filecount="1" scripts="0" /> --}}
                            <input id="" name="ine_frontalInput" type="file" class="file-loading ine_frontal" multiple>
                            <input type="hidden" class="ine_frontalImg" name="ine_frontal" value="">
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

@if($loop->first)
    @section('partialsJS')
    	@parent
    	<script>
    		$(function(){

                $('.btn-agregar-ine-frontal').on('click', function(){
                    $('input[name=chofer_id]').val($(this).data('id'));
                });

                $(".ine_frontal").fileinput({
                    uploadUrl: "{{ route('uploads_subir') }}",
                    uploadAsync: true,
                    maxFileCount: 1,
                    language: 'es',
                    showUpload: false,
                    theme: 'fa',
                    height: '70',
                    allowedFileExtensions: ['jpg', 'jpeg', 'gif', 'png'],
                    uploadExtraData: {
                        folder: "choferes/ine",
                        name: "ine_frontal"
                    }
                });
                $('.ine_frontal').on("filebatchselected", function(event, files) {
                    // trigger upload method immediately after files are selected
                    $('.kv-file-upload').click();
                });
                $('.ine_frontal').on('filedeleted', function(event, key, jqXHR, data) {
                    $(".ine_frontalImg").val("");
                });
                $('.ine_frontal').on('fileuploaded', function(event, data, previewId, index) {
                    var form = data.form,
                        files = data.files,
                        extra = data.extra,
                        response = data.response,
                        reader = data.reader;
                    $(".ine_frontalImg").val( data.response.ine_frontal );
                });

    			/*----------  Eliminar INE Frontal  ----------*/
    			$('body').on('click','.btn-eliminar-ine-frontal',function(){
                    let url = "{{ route('choferes.eliminar_ine_frontal') }}";
                    let id = $(this).data('id');

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
                                	chofer_id : id
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
@endif


