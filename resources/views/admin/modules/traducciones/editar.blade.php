@extends('admin.layouts.master')

@section('titulo', 'Editar Traducción')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Traducciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('traducciones') }}">Traducciones</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('traducciones') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar traducción</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('traducciones.editar', ['hash_id' => Hashids::encode($traduccion->id)]) }}" class="">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Grupo</label>
                                    <div class="col-md-7">
                                        <input type="text" name="grupo" value="{{ $traduccion->group }}" class="form-control" data-error="*El grupo es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Clave</label>
                                    <div class="col-md-7">
                                        <input type="text" name="key" value="{{ $traduccion->key }}" class="form-control" data-error="*La clave es requerida." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Textos</label>
                                    <div class="col-md-7">

                                        <div class="mt-3">
                                            {{-- <pre>
                                                {{ print_r($traduccion->toArray()) }}
                                            </pre> --}}
                                            @foreach($traduccion->text as $key => $value)
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="w-100">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="badge badge-primary mr-1">{{ $key }}</span>
                                                            <span>
                                                                <a href="#." class="btn btn-xs btn-primary btn-editar" data-id="{{ $traduccion->id }}" data-lang="{{ $key }}" data-val="{{ $value }}">
                                                                    <i class="fa fa-pencil-square-o"></i>
                                                                </a>
                                                                <a href="#." class="btn btn-xs btn-danger btn-eliminar" data-id="{{ $traduccion->id }}" data-lang="{{ $key }}" data-val="{{ $value }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                        <p>
                                                            {{ $value }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Traducción</label>
                                    <div class="col-12 col-md-7">
                                        <div class="some-repeating-fields row mb-3" data-ac-repeater="traduccion" data-ac-repeater-text="Agregar traducción">
                                            <div class="col-2">
                                                <input name="idioma" class="form-control" placeholder="Idioma" value="">
                                            </div>
                                            <div class="col-10">
                                                <input name="texto" class="form-control" placeholder="Texto" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Traducción --}}
    <div id="modalEditarTraduccion" class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar traducción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarTraduccionForm" action="{{ route('traducciones.editar_detalle') }}" method="post">
                        <input type="hidden" name="key" value="{{ $traduccion->key }}">
                        <input type="hidden" name="group" value="{{ $traduccion->group }}">
                        <input type="hidden" name="lang">
                        <div class="form-group">
                            <label for="">Texto <span class="label-lang badge badge-primary"></span></label>
                            <input type="text" name="val" class="form-control">
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

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent
    <x-validator />
    <script src="/admin/assets/plugins/ac-form-field-repeater.js/jquery.ac-form-field-repeater.js"></script>
    <script>
        $(function(){

            /*----------  Editar  ----------*/
            $('.btn-editar').on('click', function(e){
                let val = $(this).data('val');
                let lang = $(this).data('lang');

                $('#editarTraduccionForm input[name=val]').val(val);
                $('#editarTraduccionForm input[name=lang]').val(lang);
                $('#editarTraduccionForm .label-lang').text(lang);

                $('#modalEditarTraduccion').modal('show');

                e.preventDefault();
            });

            /*----------  Eliminar  ----------*/
            $('body').on('click','.btn-eliminar',function(){
                let val = $(this).data('val');
                let lang = $(this).data('lang');

                swal({
                    title: "Eliminar traducción",
                    text: "La información no podrá ser recuperada",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ route('traducciones.eliminar_detalle') }}",
                            cache: false,
                            type: 'post',
                            dataType: 'json',
                            data: {
                                val: val,
                                lang: lang,
                                key: "{{ $traduccion->key }}",
                                group: "{{ $traduccion->group }}"
                            },
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

    <x-ajax-form id="editarTraduccionForm" titulo="Editar traducción" reload="1" />
    <x-ajax-form id="editarForm" titulo="Editar traducción" reload="1" />
@stop