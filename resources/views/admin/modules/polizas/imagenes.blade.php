<div class="m-b-10 text-right">
    <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarImagenes">
        Agregar imágenes<i class="fa fa-plus-circle"></i>
    </a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-info">
                <h4 class="m-b-0 text-white">Imágenes</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    @forelse($poliza->imagenes as $imagen)
                        <div class="col-12 col-md-4 my-4">
                            <div style="border: dashed 1px; padding: 10px;" class="h-100 d-flex align-items-center justify-content-center">
                                <div>
                                    <img src="/uploads/{{ $imagen->imagen }}" class="img-fluid" loading="lazy" alt="">   
                                </div>
                            </div>
                            <div class="actions pt-1 text-right">
                                <x-btn-eliminar titulo="Eliminar imagen" url="{{ route('polizas.eliminar_imagen', ['hash_id'=>Hashids::encode($imagen->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
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


@section('modals')
    @parent

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
                    <form id="formAgregarImagenes" action="{{ route('polizas.agregar_imagen') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="poliza_id" value="{{ $poliza->id }}">
                        <div class="form-group mb-2">
                            <label for="">Imágenes</label>
                            <x-file-input name="imagen" route="{{ route('uploads_subir') }}" folder="polizas/{{ $poliza->id }}" filecount="50" scripts="1" />
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

@section('partialsCSS')
    @parent

@stop

@section('partialsJS')
    @parent
    <x-ajax-form id="formAgregarImagenes" titulo="Agregar Imágenes" reload="1" /> 
@stop