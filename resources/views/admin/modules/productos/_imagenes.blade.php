{{-- Imágenes --}}
<div class="m-t-10 m-b-10 text-right">
    <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarImagenes">
        Agregar <i class="fa fa-plus-circle"></i>
    </a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-info">
                <h4 class="m-b-0 text-white">Imágenes del producto</h4>
            </div>
            <div class="card-body">

                <div id="imagenes" class="row imagenes">
                    @forelse($producto->imagenes as $imagen)
                        <div class="imagen col-12 col-md-4 col-lg-3 my-4" data-id="{{ $imagen->id }}">
                            <div style="border: dashed 1px; padding: 10px;" class="h-100 d-flex align-items-center justify-content-center">
                                <div>
                                    <img src="/uploads/{{ $imagen->ruta }}" class="img-fluid" loading="lazy" alt="">
                                </div>
                            </div>
                            <div class="actions pt-1 text-right">
                                <x-btn-eliminar titulo="Eliminar Imagen" url="{{ route('imagenes.eliminar', ['hash_id'=>Hashids::encode($imagen->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <h5>No se encontraron imágenes.</h5>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>


{{-- Modal Agregar Fotos --}}
<div class="modal fade" id="modalAgregarImagenes" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Agregar Imágenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAgregarImagenes" action="{{ route('imagenes.agregar') }}" data-focus="false" data-disable="false">
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <div class="form-group mb-2">
                        <label for="">Imágenes</label>
                        <x-file-input name="imagen" route="{{ route('uploads_subir') }}" folder="productos/imagenes-productos" filecount="50" scripts="1" />
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('partialsJS')
    @parent
    <script>
        $(function(){
            /*----------  Ordenar imágenes  ----------*/
            $('#imagenes').sortable({
                group: 'imagenes',
                animation: 200,
                ghostClass: 'ghost',
                chosenClass: 'current',
                onSort: function(){
                    let orden = $('#imagenes').sortable('toArray');

                    $.ajax({
                        url: "{{ route('imagenes.ordenar') }}",
                        data: {
                            imagenes: orden
                        },
                        cache: false,
                        type: 'post',
                        dataType: 'json',
                        success: function(res){
                            swal({
                                text: res.msg,
                                type: res.class,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        }
                    });
                }
            });
        });
    </script>

    <x-ajax-form id="formAgregarImagenes" titulo="Agregar Imágenes" reload="1" />
@stop