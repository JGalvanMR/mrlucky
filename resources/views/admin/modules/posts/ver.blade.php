@extends('admin.layouts.master')

@section('titulo', 'Detalle del post')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Posts</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('posts') }}">Posts</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('posts.editar_form', ['hash_id'=>Hashids::encode($post->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('posts') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Datos generales</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h5>Título</h5>
                                <p>
                                    {{ $post->titulo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Slug</h5>
                                <p>
                                    {{ $post->slug ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @if($post->activo == '1')
                                        <span class="label label-success">Activo</span>
                                    @else
                                        <span class="label label-warning">Inactivo</span>
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha</h5>
                                <p>
                                    @if($post->fecha)
                                        {{ date('d/m/Y', strtotime($post->fecha)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Orden</h5>
                                <p>
                                    {{ $post->orden ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Imagen</h5>
                                <p>
                                    @if($post->imagen)
                                        <img src="/uploads/{{ $post->imagen }}" class="img-fluid" loading="lazy" alt="">
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Contenido</h5>
                                <p>
                                    {!! $post->contenido ?? '--' !!}
                                </p>
                                <hr>
                            </div>

                            
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    @yield('modals')
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .label-btn{ cursor: pointer; }
    </style>

@stop

@section('customJS')
    @parent    

    
    <script>
        $(function(){

        });
    </script> 
@stop