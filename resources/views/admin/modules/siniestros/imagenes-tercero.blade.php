<div class="m-b-10 text-right">
    <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarImagenesTerceros">
        Agregar imágenes<i class="fa fa-plus-circle"></i>
    </a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-info">
                <h4 class="m-b-0 text-white">Imágenes terceros</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    @forelse($siniestro->imagenes_tercero as $imagen)
                        <div class="col-12 col-md-4 my-4">
                            <div style="border: dashed 1px; padding: 10px;" class="h-100 d-flex align-items-center justify-content-center">
                                <div>
                                    <img src="/uploads/{{ $imagen->imagen }}" class="img-fluid" loading="lazy" alt="">   
                                </div>
                            </div>
                            <div class="actions pt-1 text-right">
                                <x-btn-eliminar titulo="Eliminar imagen" url="{{ route('siniestros.eliminar_imagen_tercero', ['hash_id'=>Hashids::encode($imagen->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
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

    {{-- Modal Agregar Imagenes Terceros --}}
    <div class="modal fade" id="modalAgregarImagenesTerceros" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Agregar Imágenes Tercero</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarImagenesTercero" action="{{ route('siniestros.agregar_imagen_tercero') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="siniestro_id" value="{{ $siniestro->id }}">
                        <div class="form-group mb-2">
                            <label for="">Imágenes</label>
                            <x-file-input name="imagen_tercero" route="{{ route('uploads_subir') }}" folder="siniestros-tercero/{{ $siniestro->id }}" filecount="50" scripts="0" />
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
    <x-ajax-form id="formAgregarImagenesTercero" titulo="Agregar Imágenes Tercero" reload="1" /> 
@stop