@extends('admin.layouts.master')

@section('titulo', 'Respaldos')

@section('page')
	<div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Configuraciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Respaldos</li>
                </ol>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Respaldos</h4>
                    </div>
                    <div class="card-body">
                        <livewire:laravel_backup_panel::app />
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('customCSS')
    @parent
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    {{-- <link href="{{ asset('vendor/laravel_backup_panel/app.css') }}" rel="stylesheet"> --}}
    @livewireStyles

    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @livewireScripts
    
@stop