<div class="m-b-10 text-right">
    <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarChofer">
        Agregar Chofer <i class="fa fa-plus-circle"></i>
    </a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-info">
                <h4 class="m-b-0 text-white">Choferes</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($poliza->choferes as $chofer)
                        {{-- Chofer --}}
                        <div class="col-12 mt-3">
                            <h4 class="bg-primary text-white px-2 py-1">{{ $loop->iteration }} - {{ $chofer->nombre ?? '--' }}  {{ $chofer->apellido_paterno ?? '' }} {{ $chofer->apellido_materno ?? '' }}</h4>
                        </div>
                        {{-- <div class="col-12 col-md-4">
                            <h5>Nombre</h5>
                            <p>
                                {{ $chofer->nombre ?? '--' }}
                            </p>
                            <hr>
                        </div>
                        <div class="col-12 col-md-4">
                            <h5>Apellido paterno</h5>
                            <p>
                                {{ $chofer->apellido_paterno ?? '--' }}
                            </p>
                            <hr>
                        </div>
                        <div class="col-12 col-md-4">
                            <h5>Apellido materno</h5>
                            <p>
                                {{ $chofer->apellido_materno ?? '--' }}
                            </p>
                            <hr>
                        </div> --}}
                        <div class="col-12 col-md-4">
                            <h5>Fecha de nacimiento</h5>
                            <p>
                                @if($chofer->fecha_nacimiento)
                                    {{ date('d/m/Y', strtotime($chofer->fecha_nacimiento)) }}
                                @else
                                    --
                                @endif
                            </p>
                            <hr>
                        </div>
                        <div class="col-12 col-md-4">
                            <h5>Género</h5>
                            <p>
                                @if($chofer->genero == 'h')
                                    Hombre
                                @else
                                    Mujer
                                @endif
                            </p>
                            <hr>
                        </div>
                        <div class="col-12 col-md-4">
                            <h5>Acciones</h5>
                            <a href="#." class="btn btn-primary btn-xs btn-editar-chofer" data-toggle="tooltip" title="Editar" data-id="{{ $chofer->id }}" data-nombre="{{ $chofer->nombre }}" data-apellido-paterno="{{ $chofer->apellido_paterno }}" data-apellido-materno="{{ $chofer->apellido_materno }}" data-nacimiento="{{ $chofer->fecha_nacimiento }}" data-genero="{{ $chofer->genero }}" data-action="{{ route('choferes.editar', ['hash_id'=>Hashids::encode($chofer->id)]) }}">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <x-btn-eliminar titulo="Eliminar chofer" url="{{ route('choferes.eliminar', ['hash_id'=>Hashids::encode($chofer->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
                            <hr>
                        </div> 
                        <div class="col-12 col-md-4">
                            <h5>Licencia</h5>
                            <p>
                                @include('admin.modules.polizas.licencia') 
                            </p>
                            <hr>
                        </div>
                        <div class="col-12 col-md-4">
                            <h5>INE Frontal</h5>
                            <p>
                                @include('admin.modules.polizas.ine-frontal') 
                            </p>
                            <hr>
                        </div>
                        <div class="col-12 col-md-4">
                            <h5>INE Reverso</h5>
                            <p>
                                @include('admin.modules.polizas.ine-reverso') 
                            </p>
                            <hr>
                        </div>
                    @empty
                        <div class="col-12">
                            <h5>No se encontraron choferes.</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


@section('modals')
    @parent

    {{-- Modal Agregar Chofer --}}
    <div class="modal fade" id="modalAgregarChofer" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Agregar Chofer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarChofer" action="{{ route('choferes.agregar') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="poliza_id" value="{{ $poliza->id }}">
                        <div class="form-group mb-2">
                            <label for="">*Nombre</label>
                            <input type="text" name="nombre" class="form-control" data-error="*El nombre es requerido." required>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">*Apellido paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control" data-error="*El apellido paterno es requerido." required>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">*Apellido materno</label>
                            <input type="text" name="apellido_materno" class="form-control" data-error="*El apellido materno es requerido." required>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Fecha de nacimiento</label>
                            <x-date name="fecha_nacimiento" />
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Género</label>
                            <select name="genero" class="form-control">
                                <option value="h">Hombre</option>
                                <option value="m">Mujer</option>
                            </select>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Editar Chofer --}}
    <div class="modal fade" id="modalEditarChofer" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Editar Chofer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarChofer" action="" data-focus="false" data-disable="false">
                        <input type="hidden" name="poliza_id" value="{{ $poliza->id }}">
                        <div class="form-group mb-2">
                            <label for="">*Nombre</label>
                            <input type="text" name="nombre" class="form-control" data-error="*El nombre es requerido." required>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">*Apellido paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control" data-error="*El apellido paterno es requerido." required>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">*Apellido materno</label>
                            <input type="text" name="apellido_materno" class="form-control" data-error="*El apellido materno es requerido." required>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Fecha de nacimiento</label>
                            <x-date name="fecha_nacimiento" />
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Género</label>
                            <select name="genero" class="form-control">
                                <option value="h">Hombre</option>
                                <option value="m">Mujer</option>
                            </select>
                            <small class="help-block with-errors"></small>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Guardar</button>
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

            /*----------  Editar Chofer  ----------*/
            $('.btn-editar-chofer').on('click', function(){
                $('#formEditarChofer input[name=nombre]').val($(this).data('nombre'));
                $('#formEditarChofer input[name=apellido_paterno]').val($(this).data('apellido-paterno'));
                $('#formEditarChofer input[name=apellido_materno]').val($(this).data('apellido-materno'));
                $('#formEditarChofer input[name=fecha_nacimiento]').val($(this).data('nacimiento'));
                $('#formEditarChofer select[name=genero]').val($(this).data('genero'));
                $('#formEditarChofer').attr('action', $(this).data('action'));
                $('#modalEditarChofer').modal('show');
            });
        });
    </script>
    <x-ajax-form id="formAgregarChofer" titulo="Agregar Chofer" reload="1" /> 
    <x-ajax-form id="formEditarChofer" titulo="Agregar Chofer" reload="1" /> 
@stop