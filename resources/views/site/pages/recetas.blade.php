@extends('site.layouts.master')
@php
	$active = 'recetas';
@endphp

@section('page')
	@switch(App::currentLocale())
		@case('es')
			<img src="/site/img/banner-recetas.jpg" loading="lazy" class="img-fluid w-100">
			@break
		@case('en')
			<img src="/site/img/banner-recipes.jpg" loading="lazy" class="img-fluid w-100">
			@break
	@endswitch

	{{-- @if($recetas->count()) --}}
		<section class="bg-gris-claro padding">
			<div class="container">
				<div class="row mb-5">
					<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
						<img src="/site/img/icons/receta-ingredientes.png" alt="" class="img-fluid">
						<div class="bg-white p-2">
							<select id="ingredientes" name="" class="form-control select2">
								<option value="">{{ trans('recetas.ingredientes_label') }}</option>
								@foreach($ingredientes as $ingrediente)
									<option value="{{ $ingrediente->id }}" {{ ($ingrediente->id == request('ingredientes')) ? 'selected' : '' }}>{{ $ingrediente->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
						<img src="/site/img/icons/receta-tipo.png" alt="" class="img-fluid">
						<div class="bg-white p-2">
							<select id="categoria" name="" class="form-control select2">
								<option value="">{{ trans('recetas.categorias_label') }}</option>
								@foreach($categorias as $categoria)
									<option value="{{ $categoria->id }}" {{ ($categoria->id == request('categoria')) ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
						<img src="/site/img/icons/receta-tiempo.png" alt="" class="img-fluid">
						<div class="bg-white p-2">
							<select id="tiempo" name="" class="form-control select2">
								<option value="">{{ trans('recetas.tiempo_label') }}</option>
								<option value="15" {{ (request('tiempo') == 15) ? 'selected' : '' }}>{{ trans('recetas.15min') }}</option>
								<option value="30" {{ (request('tiempo') == 30) ? 'selected' : '' }}>{{ trans('recetas.30min') }}</option>
								<option value="45" {{ (request('tiempo') == 45) ? 'selected' : '' }}>{{ trans('recetas.45min') }}</option>
								<option value="60" {{ (request('tiempo') == 60) ? 'selected' : '' }}>{{ trans('recetas.60min') }}</option>
								<option value="90" {{ (request('tiempo') == 90) ? 'selected' : '' }}>{{ trans('recetas.90min') }}</option>
								<option value="120" {{ (request('tiempo') == 120) ? 'selected' : '' }}>{{ trans('recetas.120min') }}</option>
							</select>
						</div>
					</div>
				</div>

				<h2 class="text-center azul-claro pacifico mb-4">{{ trans('web.nuestras_recetas') }}</h2>
				<div class="row recetas">
					@foreach($recetas as $receta)
						<div class="col-12 col-md-4 mb-5">
							<a href="{{ route( App::currentLocale() . '.receta', ['slug' => $receta->slug] ) }}">
								<div class="receta">
									<img src="/uploads/{{ $receta->imagen }}" class="img-fluid" alt="{{ $receta->titulo }}" alt="{{ $receta->titulo }}" loading="lazy">
									<div class="px-3 pb-2">
										@if($receta->tiempo)
											<div class="text-center">
												<span class="tiempo small">{{ $receta->tiempo }} min <i class="fa fa-clock-o text-white"></i></span>
											</div>
										@endif
										<h3 class="h5 small gris text-center">{{ $receta->titulo }}</h3>
									</div>
								</div>
							</a>
						</div>
					@endforeach

					<div class="w-100 d-flex justify-content-center align-items-center">
						@php
							$recetas->appends(request()->query());
						@endphp
						{{ $recetas->links() }}
					</div>
				</div>
			</div>
		{{-- @endif --}}
	</section>
@stop

@section('customCSS')
	@parent
	<style>
		select, .select2-search, .select2-results{
			background: #22b556 !important;
			color: #fff !important;
			text-transform: uppercase;
			font-weight: 600;
		}
		.select2-results li{
			color: #fff !important;
		}
		.receta .tiempo{ display: inline-block; color: #fff; background-color:#DC3433; border-radius: 20px; transform: translateY(-15px); padding:5px 10px;}
	</style>
@stop

@section('customJS')
	@parent
	<x-select2 />
	<script>
		$(function(){

			$('#categoria, #tiempo, #ingredientes').on('change', function(){
				window.location.replace("{{ route( App::currentLocale() . '.recetas') }}?categoria="+$('#categoria').val()+"&tiempo="+$('#tiempo').val()+"&ingredientes="+$('#ingredientes').val());
			});
		});
	</script>
@stop