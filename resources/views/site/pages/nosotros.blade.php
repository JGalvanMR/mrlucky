@extends('site.layouts.master')
@php
    $active = 'nosotros';
@endphp

@section('page')
    @if(App::currentLocale() == 'es')
        <img src="/site/img/banner-nosotros.jpg" loading="lazy" class="img-fluid w-100">
    @else
    	<img src="/site/img/banner-nosotros-en.jpg" loading="lazy" class="img-fluid w-100">
    @endif

	<section id="sa" class="section-nosotros padding pb-0">
		<div class="container">
			<h2 class="text-center rojo pacifico h1 mb-4 editable" data-key="nosotros" data-group="nosotros">{!! trans('nosotros.nosotros') !!}</h2>
			<div class="m800 mx-auto">
				<p class="azul-marino text-center editable" data-key="comienzos" data-group="nosotros">
					{!! trans('nosotros.comienzos') !!}
				</p>
			</div>
			<div class="row mt-4">
				<div class="col-12 col-md-6">
					<img src="/site/img/nosotros-01.jpg" class="img-fluid" loading="lazy" alt="">
					<p class="mt-3 text-center gris">

					</p>
				</div>
				<div class="col-12 col-md-6 row no-gutters">
					<div class="col-12 order-md-2">
						<img src="/site/img/nosotros-02.jpg" class="img-fluid" loading="lazy" alt="">
					</div>
					<div class="col-12 order-md-1">
						<p class="mt-3 text-center gris editable" data-key="somos" data-group="nosotros">
							{!! trans('nosotros.somos') !!}
						</p>
					</div>
				</div>
			</div>

			<div class="m400 mx-auto my-5">
				<h2 class="h4 azul-marino f600 text-center editable" data-key="cosechando" data-group="nosotros">{!! trans('nosotros.cosechando') !!}</h2>
			</div>
			<div class="m1000 mx-auto row">
				<div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
					<img src="/site/img/icons/excelencia.png" loading="lazy" class="img-fluid mb-2">
					<h5 class="text-uppercase f600 excelencia editable" data-key="excelencia" data-group="nosotros">{!! trans('nosotros.excelencia') !!}</h5>
				</div>
				<div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
					<img src="/site/img/icons/innovacion.png" loading="lazy" class="img-fluid mb-2">
					<h5 class="text-uppercase f600 innovacion editable" data-key="innovacion" data-group="nosotros">{!! trans('nosotros.innovacion') !!}</h5>
				</div>
				<div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
					<img src="/site/img/icons/sustentabilidad.png" loading="lazy" class="img-fluid mb-2">
					<h5 class="text-uppercase f600 sustentabilidad editable" data-key="sustentabilidad" data-group="nosotros">{!! trans('nosotros.sustentabilidad') !!}</h5>
				</div>
				<div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
					<img src="/site/img/icons/responsabilidad.png" loading="lazy" class="img-fluid mb-2">
					<h5 class="text-uppercase f600 responsabilidad editable" data-key="responsabilidad" data-group="nosotros">{!! trans('nosotros.responsabilidad') !!}</h5>
				</div>
			</div>
		</div>
	</section>
	<section class="mr-lucky">
		<div class="m800 mx-auto">
			<div class="rounded bg-lila p-4 text-white text-center editable" data-key="medio_siglo" data-group="nosotros">
				{!! trans('nosotros.medio_siglo') !!}
			</div>
		</div>
	</section>

	<div class="my-3 my-md-0">
		<img src="/site/img/portada-02-nosotros.jpg" alt="" class="img-fluid w-100">
	</div>

	<section class="section-nacen padding">
		<div class="container">
			<h2 class="h3 text-center naranja text-uppercase editable" data-key="nacen" data-group="nosotros">{!! trans('nosotros.nacen') !!}</h2>
			<div class="m700 mx-auto text-center text-white my-4 editable" data-key="producimos" data-group="nosotros">
				{!! trans('nosotros.producimos') !!}
			</div>
		</div>
	</section>
	<section class="mayor-impacto">
		<div class="m700 mx-auto">
			<div class="rounded bg-azul-claro p-4 text-white text-center editable" data-key="mayor_impacto" data-group="nosotros">
				{!! trans('nosotros.mayor_impacto') !!}
			</div>
		</div>
	</section>
	<section class="section-ubicaciones">
		<div class="container">
			<div class="row numeralia">
				<div class="col-6 col-md-3 text-center">
					<div class="count h1 azul-marino editable" data-group="nosotros" data-key="num_01">{!! trans('nosotros.num_01') !!}</div>
					<p class="h4 azul-marino editable" data-key="hectareas_cultivo" data-group="nosotros">
						{!! trans('nosotros.hectareas_cultivo') !!}
					</p>
				</div>
				<div class="col-6 col-md-3 text-center">
					<div class="count h1 azul-marino editable" data-group="nosotros" data-key="num_02">{!! trans('nosotros.num_02') !!}</div>
					<p class="h4 azul-marino editable" data-key="cultivo_abierto" data-group="nosotros">
						{!! trans('nosotros.cultivo_abierto') !!}
					</p>
				</div>
				<div class="col-6 col-md-3 text-center">
					<div class="count h1 azul-marino editable" data-group="nosotros" data-key="num_03">{!! trans('nosotros.num_03') !!}</div>
					<p class="h4 azul-marino editable" data-key="invernaderos" data-group="nosotros">
						{!! trans('nosotros.invernaderos') !!}
					</p>
				</div>
				<div class="col-6 col-md-3 text-center">
					<p class="h4 azul-marino editable" data-key="campos_hasta" data-group="nosotros">
						{!! trans('nosotros.campos_hasta') !!}
					</p>
					<div class="count h1 azul-marino editable" data-group="nosotros" data-key="num_04">{!! trans('nosotros.num_04') !!}</div>
					<p class="h4 azul-marino editable" data-key="metros" data-group="nosotros">
						{!! trans('nosotros.metros') !!}
					</p>
				</div>
			</div>
			@if(App::currentLocale() == 'es')
		    	<img src="/site/img/ubicaciones.jpg" loading="lazy" class="img-fluid w-100">
		    @else
		    	<img src="/site/img/ubicaciones-en.jpg" loading="lazy" class="img-fluid w-100">
		    @endif
		</div>
	</section>

	<img src="/site/img/distribucion-banner.jpg" loading="lazy" class="img-fluid w-100">

	<section class="section-distribucion padding">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6 d-flex align-items-center">
					<div>
						<h2 class="azul-claro pacifico mb-4" data-key="distribucion" data-group="nosotros">{!! trans('nosotros.distribucion') !!}</h2>
						<p class="h5 lila editable" data-key="durante" data-group="nosotros">
							{!! trans('nosotros.durante') !!}
						</p>
						<p class="azul-marino editable" data-key="optima_infraestructura" data-group="nosotros">
							{!! trans('nosotros.optima_infraestructura') !!}
						</p>
					</div>
				</div>
				<div class="col-12 col-md-6">
                    @if(App::currentLocale() == 'es')
                        <img src="/site/img/mapa-distribucion.jpg" loading="lazy" class="img-fluid">
		            @else
                        <img src="/site/img/mapa-distribucion-en.jpg" loading="lazy" class="img-fluid">
		            @endif
				</div>
			</div>
		</div>
	</section>

	@if(App::currentLocale() == 'es')
		<img src="/site/img/banner-nuestra-gente.jpg" loading="lazy" class="img-fluid w-100">
    @else
    	<img src="/site/img/banner-our-people.jpg" loading="lazy" class="img-fluid w-100">
    @endif
	<section class="section-nuestra-gente padding">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6">
					<img src="/site/img/nuestra-gente.jpg" loading="lazy" class="img-fluid">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center">
					<div class="text-center">
						<h2 class="azul-marino pacifico mb-4 editable" data-key="nuestra_gente" data-group="nosotros">{!! trans('nosotros.nuestra_gente') !!}</h2>
						<p class="gris editable" data-key="nuestro_recurso" data-group="nosotros">
							{!! trans('nosotros.nuestro_recurso') !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-filosofia bg-gris-claro py-5">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-5">
					<h2 class="azul-marino pacifico text-center mb-4 editable" data-key="valores" data-group="nosotros">{!! trans('nosotros.valores') !!}</h2>
					<div class="m800 mx-auto">
						<p class="text-center gris editable" data-key="nuestro_inicio" data-group="nosotros">
							{!! trans('nosotros.nuestro_inicio') !!}
						</p>
					</div>
					<div class="text-center">
						<div class="btn bg-naranja text-white px-4 rounded-pill" data-key="principal_motivador" data-group="nosotros">
							{!! trans('nosotros.principal_motivador') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row d-flex align-items-center">
				<div class="col-12 col-md-7 order-md-2 mb-3 mb-md-0">
					<img src="/site/img/valores-01.jpg" loading="lazy" class="img-fluid rounded">
				</div>
				<div class="col-12 col-md-5 order-md-1">
					<h3 class="h2 azul-marino pacifico text-center editable" data-key="nuestros_valores" data-group="nosotros">{!! trans('nosotros.nuestros_valores') !!}</h3>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="respeto" data-group="nosotros">{!! trans('nosotros.respeto') !!}</h5>
						<p class="gris editable" data-key="respeto_text" data-group="nosotros">
							{!! trans('nosotros.respeto_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="comunicacion" data-group="nosotros">{!! trans('nosotros.comunicacion') !!}</h5>
						<p class="gris editable" data-key="comunicacion_text" data-group="nosotros">
							{!! trans('nosotros.comunicacion_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="responsabilidad_titulo" data-group="nosotros">{!! trans('nosotros.responsabilidad_titulo') !!}</h5>
						<p class="gris editable" data-key="responsabilidad_text" data-group="nosotros">
							{!! trans('nosotros.responsabilidad_text') !!}
						</p>
						<hr>
					</div>
				</div>
			</div>

			<div class="row d-flex align-items-center mt-4">
				<div class="col-12 col-md-7 mb-3 mb-md-0">
					<img src="/site/img/valores-02.jpg" loading="lazy" class="img-fluid rounded">
				</div>
				<div class="col-12 col-md-5">
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="tolerancia" data-group="nosotros">{!! trans('nosotros.tolerancia') !!}</h5>
						<p class="gris editable" data-key="tolerancia_text" data-group="nosotros">
							{!! trans('nosotros.tolerancia_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="dignidad" data-group="nosotros">{!! trans('nosotros.dignidad') !!}</h5>
						<p class="gris editable" data-key="dignidad_text" data-group="nosotros">
							{!! trans('nosotros.dignidad_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="justicia" data-group="nosotros">{!! trans('nosotros.justicia') !!}</h5>
						<p class="gris editable" data-key="justicia_text" data-group="nosotros">
							{!! trans('nosotros.justicia_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="prudencia" data-group="nosotros">{!! trans('nosotros.prudencia') !!}</h5>
						<p class="gris editable" data-key="prudencia_text" data-group="nosotros">
							{!! trans('nosotros.prudencia_text') !!}
						</p>
						<hr>
					</div>
				</div>
			</div>

			<div class="row d-flex align-items-center">
				<div class="col-12 col-md-7 order-md-2 mb-3 mb-md-0">
					<img src="/site/img/valores-03.jpg" loading="lazy" class="img-fluid rounded">
				</div>
				<div class="col-12 col-md-5 order-md-1">
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="reconocimiento" data-group="nosotros">{!! trans('nosotros.reconocimiento') !!}</h5>
						<p class="gris editable" data-key="reconocimiento_text" data-group="nosotros">
							{!! trans('nosotros.reconocimiento_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="equidad" data-group="nosotros">{!! trans('nosotros.equidad') !!}</h5>
						<p class="gris editable" data-key="equidad_text" data-group="nosotros">
							{!! trans('nosotros.equidad_text') !!}
						</p>
						<hr>
					</div>
					<div>
						<h5 class="azul-claro text-uppercase f600 editable" data-key="equipo" data-group="nosotros">{!! trans('nosotros.equipo') !!}</h5>
						<p class="gris editable" data-key="equipo_text" data-group="nosotros">
							{!! trans('nosotros.equipo_text') !!}
						</p>
						<hr>
					</div>
				</div>
			</div>

		</div>
	</section>
@stop

@section('customCSS')
	@parent
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
	<script>
		$(function(){
			/*----------  Numeralia  ----------*/
			if($(".count").length){
				$('.count').counterUp({
		            delay: 10,
		            time: 1000
		        });
			}
		});
	</script>
@stop