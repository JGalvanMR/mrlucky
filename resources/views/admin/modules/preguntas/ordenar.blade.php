@extends('admin.layouts.master')

@section('titulo', 'Ordenar preguntas')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Preguntas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('preguntas') }}">Preguntas Frecuentes</a></li>
                    <li class="breadcrumb-item active">Ordenar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('preguntas.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
            <a href="{{ route('preguntas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Ordenar preguntas</h4>
                    </div>
                    <div class="card-body">
                        <div id="preguntas" class="preguntas p-2 row">
                            @foreach($preguntas as $pregunta)
                                {{-- pregunta --}}
                                <div class="pregunta px-2 my-2 col-12" data-id="{{ $pregunta->id }}">
                                    <div class="px-3 py-2" style="opacity: {{ ($pregunta->activo == '0') ? '.45' : '1' }}; border: dashed 2px #00ADBA;">
                                        <h3>{{ $loop->iteration }} - {{ $pregunta->pregunta ?? '--' }}</h3>
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
        .pregunta h3{ font-weight: 600; margin:0; }
        .pregunta{
            cursor: move;
        }
        .pregunta:hover{
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

            $('#preguntas').sortable({
                group: 'preguntas',
                animation: 200,
                ghostClass: 'ghost',
                chosenClass: 'current',
                onSort: function(){
                    let orden = $('#preguntas').sortable('toArray');

                    $.ajax({
                        url: "{{ route('preguntas.ordenar') }}",
                        data: {
                            preguntas: orden
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


@stop