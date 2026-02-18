@extends('site.layouts.master')
@php
	$active = 'recetas';
@endphp

@section('page')
	<section class="section-receta padding">
		<div class="container">
			<h2 class="text-center verde pacifico mb-4 d-block">{{ $receta->titulo }}</h2>
			@if($receta->imagen)
				<div class="bg-white p-2 rounded">
					<img src="/uploads/{{ $receta->imagen}}" alt="" class="img-fluid w-100" loading="lazy">
				</div>
			@endif
			<div class="row py-4">
				<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
					<h5 class="f600 azul-marino">Preparación</h5>
					@if($receta->tiempo )
						{{ $receta->tiempo  }} min.
					@else
						--
					@endif
				</div>
				<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
					<h5 class="f600 azul-marino">Cocción</h5>
					@if($receta->coccion )
						{{ $receta->coccion  }} min.
					@else
						--
					@endif
				</div>
				<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
					<h5 class="f600 azul-marino">Porciones</h5>
					@if($receta->porciones )
						{{ $receta->porciones  }} Porciones
					@else
						--
					@endif
				</div>
			</div>
			<div class="row py-4">
				<div class="col-12 col-md-4">
					<h3 class="pacifico verde mb-4">Ingredientes:</h3>
					{!! $receta->ingredientes ?? '' !!}
				</div>
				<div class="col-12 col-md-7 offset-md-1">
					<h3 class="pacifico verde mb-4">Procedimiento:</h3>
					<div class="bg-white p-3 procedimiento">
						{!! $receta->contenido ?? '' !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@stop

@section('customCSS')
	@parent
	<style>
		b, strong{ font-weight: 600; }
		.receta .tiempo{ display: inline-block; color: #fff; background-color:#DC3433; border-radius: 20px; transform: translateY(-15px); padding:5px 10px;}
		.procedimiento li{ margin-bottom: 15px; }
	</style>
@stop

@section('customJS')
	@parent
	<script>
		$(function(){

		});
	</script>
@stop