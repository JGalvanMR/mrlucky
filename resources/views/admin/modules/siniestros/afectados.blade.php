<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-info">
                <h4 class="m-b-0 text-white">Afectados del siniestro</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="bg-primary text-white px-2 py-1">Afectados</h4>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th>Implicación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siniestro->afectados as $afectado)
                                            <tr>
                                                <td>{{ $afectado->nombre ?? '--' }}</td>
                                                <td>
                                                    @if($afectado->estado == 'les')
                                                        Lesionado
                                                    @else
                                                        Fallecido
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($afectado->implicacion == 'aco')
                                                        Acompañante
                                                    @else
                                                        Tercero
                                                    @endif
                                                </td>
                                                <td>
                                                    <x-btn-eliminar titulo="Eliminar afectado" url="{{ route('afectados.eliminar', ['hash_id'=>Hashids::encode($afectado->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
                                                </td>
                                            </tr>   
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="bg-primary text-white px-2 py-1">Agregar afectado</h4>
                            </div>
                            <div class="col-12">
                                <div class="p-3">
                                    <form id="agregarAfectadosForm" action="{{ route('afectados.agregar') }}" class="form-horizontal form-bordered" novalidate="true">
                                        <input type="hidden" name="siniestro_id" value="{{ $siniestro->id }}">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" data-error="*El nombre es requerido." required="">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <select name="estado" class="form-control">
                                                <option value="les">Lesionado</option>
                                                <option value="fal">Fallecido</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Implicación</label>
                                            <select name="implicacion" class="form-control">
                                                <option value="aco">Acompañante</option>
                                                <option value="ter">Tercero</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block disabled">
                                                Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>

            </div>
        </div>
    </div>
</div>


@section('partialsCSS')
    @parent

@stop


@section('partialsJS')
    @parent
    <x-ajax-form id="agregarAfectadosForm" titulo="Agregar Afectado" reload="1" />
@stop