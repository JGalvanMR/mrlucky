<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-info">
                <h4 class="m-b-0 text-white">Expedientes digitales</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="bg-primary text-white px-2 py-1">Expedientes</h4>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Expediente</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($siniestro->expedientes as $expediente)
                                            @php
                                                $info = pathinfo(public_path().'/uploads/'.$expediente->documento);
                                                $ext = $info['extension'];
                                            @endphp
                                            <tr>
                                                {{-- <td>{{ $expediente->id }}</td> --}}
                                                <td>
                                                    @if($ext == 'pdf')
                                                        <a href="/uploads/{{ $expediente->documento }}" class="btn btn-info btn-xs magnificPdf">
                                                            <i class="fa fa-file-pdf-o"></i> PDF
                                                        </a>
                                                    @else
                                                        <a href="/uploads/{{ $expediente->documento }}" class="magnificImg">
                                                            <img src="/uploads/{{ $expediente->documento }}" class="img-fit" style="width: 100px;" alt="">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <x-btn-eliminar titulo="Eliminar expediente" url="{{ route('expedientes.eliminar', ['hash_id'=>Hashids::encode($expediente->id)]) }}" scripts="1" btn="1" />
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
                                <h4 class="bg-primary text-white px-2 py-1">Agregar Expediente</h4>
                            </div>
                            <div class="col-12">
                                <div class="p-3">
                                    <form id="agregarExpedientesForm" action="{{ route('expedientes.agregar') }}" class="form-horizontal form-bordered" novalidate="true">
                                        <input type="hidden" name="siniestro_id" value="{{ $siniestro->id }}">
                                        <div class="form-group mb-2">
                                            <label for="">Expediente</label>
                                            <x-file-input name="expediente" route="{{ route('uploads_subir') }}" ext="jpg,jpeg,png,gif,pdf" folder="siniestros/expedientes/{{ $siniestro->id }}" filecount="20" scripts="1" />
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
    <x-ajax-form id="agregarExpedientesForm" titulo="Agregar Expediente" reload="1" />
    <script>
        $(function(){
            /*----------  Vistas previas  ----------*/
            if($('.magnificImg').length){
                $('.magnificImg').magnificPopup({
                    type:'image'
                });
            }
            if($('.magnificPdf').length){
                $('.magnificPdf').magnificPopup({
                    type:'iframe'
                });
            }
        });
    </script>
@stop