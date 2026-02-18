@extends('admin.layouts.master')

@section('titulo', 'Ordenar categorías')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Categorías Producto</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('categorias_productos') }}">Categorías producto</a></li>
                    <li class="breadcrumb-item active">Ordenar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('categorias_productos.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
            <a href="{{ route('categorias_productos') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 mb-3">
                <select id="idioma" name="idioma_id" class="form-control select2">
                    <option value="">- Seleccione un idioma </option>
                    @foreach($idiomas as $idioma)
                        <option value="{{ $idioma->id }}" {{ (request('idioma_id') == $idioma->id) ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">

                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Ordenar Categorías</h4>
                    </div>
                    <div class="card-body">
                        <div id="categorias" class="categorias p-2 row">
                            @foreach($categorias as $categoria)
                                {{-- categoría --}}
                                <div class="categoria px-2 my-2 col-12" data-id="{{ $categoria->id }}">
                                    <div class="px-3 py-2 d-flex align-items-center" style="opacity: {{ ($categoria->activo == '0') ? '.45' : '1' }}; border: dashed 2px #00ADBA;">
                                        @if($categoria->banner)
                                            <img src="/uploads/{{ $categoria->banner }}" loading="lazy" class="img-fluid" alt="">
                                        @endif
                                        <h3 class="font-weight-bold text-info">{{ $loop->iteration }} - {{ $categoria->nombre ?? '--' }}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .categoria h3{ font-weight: 600; margin:0; }
        .categoria{
            cursor: move;
        }
        .categoria:hover{
            background-color: #E9ECEF;
        }
        .ghost{
            opacity: 0;
        }
        .current{
            background-color: #00ADBA !important;
            opacity: .5 !important;
        }
    </style>
@stop

@section('customJS')
    @parent
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

    <script>
        $(function(){

            $('#categorias').sortable({
                group: 'categorias',
                animation: 200,
                ghostClass: 'ghost',
                chosenClass: 'current',
                onSort: function(){
                    let orden = $('#categorias').sortable('toArray');

                    $.ajax({
                        url: "{{ route('categorias_productos.ordenar') }}",
                        data: {
                            categorias: orden
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

            /*----------  Idioma Select  ----------*/
            $("#idioma").on('change', function(){
                location.href="{{ route('categorias_productos.ordenar_form') }}/"+$(this).val();
            });


        });
    </script>


@stop