@extends('site.layouts.master')
@php
    $active = 'vacantes';
@endphp

@section('page')
    @switch(App::currentLocale())
        @case('es')
			<img src="/site/img/banner-vacantes.jpg" loading="lazy" class="img-fluid w-100">
			@break
		@case('en')
			<img src="/site/img/banner-vacancies.jpg" loading="lazy" class="img-fluid w-100">
			@break
	@endswitch

	@if($vacantes->count())
		<section class="bg-gris-claro padding">
			<div class="container">

				{{-- <h2 class="text-center azul-claro pacifico mb-4">{{ trans('web.nuestras_vacantes') }}</h2> --}}
				<div class="row vacantes">
					@foreach($vacantes as $vacante)
						<div class="col-12 col-md-4 mb-5">
							<a href="{{ route( App::currentLocale() . '.vacante', ['slug' => $vacante->slug] ) }}" class="text-decoration-none">
								<div class="vacante card p-2 rounded shadow h-100">
									<img src="/uploads/{{ $vacante->imagen }}" class="img-fluid" alt="{{ $vacante->titulo }}" alt="{{ $vacante->titulo }}" loading="lazy">
									<div class="px-3 pb-2 bg-verde">
										<span class="f600 d-block gris text-center text-white m-0 p-2">{{ $vacante->titulo }}</span>
									</div>
									<div class="small p-2">
										{!! Str::limit($vacante->requisitos, 120) !!}
									</div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</section>
@stop

@section('customCSS')
	@parent
	<style>
		select{
			background: #22b556 !important;
			color: #fff !important;
			text-transform: uppercase;
			font-weight: 600;
		}
		.receta .tiempo{ display: inline-block; color: #fff; background-color:#DC3433; border-radius: 20px; transform: translateY(-15px); padding:5px 10px;}
	</style>
@stop

@section('customJS')
	@parent
	<script>
		$(function(){

		});
	</script>
@stop