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

	<section class="bg-white padding section-vacante">
		<div class="container">

			@if($vacante->imagen)
				<div class="m500 mx-auto mb-3">
					<img src="/uploads/{{ $vacante->imagen }}" alt="" class="img-fluid">
				</div>
			@endif
			<h2 class="h4 text-center verde text-uppercase mb-5">{{ $vacante->titulo }}</h2>
			<div class="row vacantes">
				<div class="col-12 col-md-6 mb-4 mb-md-0">
					<div class="requisitos">
						<div class="titulo">
							Requisitos
						</div>
						<div class="mt-3">
							{!! $vacante->requisitos ?? '' !!}
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="ofrecemos">
						<h5 class="titulo">Ofrecemos:</h5>
						{!! $vacante->ofrecemos ?? '' !!}
					</div>
					<div class="interesados mt-4">
						<h5 class="titulo">Interesados</h5>
						<div class="text-uppercase gris f600 mt-2">Enviar CV al correo:</div>
						<p>
							<a href="mailto:reclutamiento@mrlucky.com.mx" class="azul-marino">reclutamiento@mrlucky.com.mx</a><br>
							<a href="mailto:rosa.rodriguez@mrlucky.com.mx" class="azul-marino">rosa.rodriguez@mrlucky.com.mx</a>
						</p>
						<p class="mt-2">
							<a href="tel:4626262663" class="azul-marino">Tel: 462 62 62663  ext. 168</a>
						</p>
					</div>
				</div>
				<div class="col-12 mt-5 text-center">
					<a class="btn-vacantes" href="https://form.jotform.com/231937102036044" target="_blank">
						Envíanos tus datos
					</a>
				</div>
			</div>
		</div>
	</section>
@stop

@section('customCSS')
	@parent
	<style>

	</style>
@stop

@section('customJS')
	@parent
	<script>
		$(function(){

		});
	</script>
@stop