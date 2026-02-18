@extends('site.layouts.master')

@php
    $config = new Larapack\ConfigWriter\Repository('rentas');
    $active = 'home';
@endphp

@section('page')
    @if($slides->count())
        <div id="sliderPrincipal" class="carousel slide" data-ride="carousel" data-entrance="fade" data-entrance-delay="500">
            <ol id="indicators" class="carousel-indicators">
                @foreach($slides as $slide)
                    <li data-target="#sliderPrincipal" data-slide-to="{{ $loop->iteration - 1 }}" class="{{ ($loop->first) ? 'active' : '' }}"></li>
                   @endforeach
            </ol>
            <div id="slides" class="carousel-inner">
                @foreach($slides as $slide)
        	        <div class="carousel-item {{ ($loop->first) ? 'active' : '' }}">
			            <a href="{{ ($slide->enlace) ? $slide->enlace : '' }}" target="{{ ($slide->target_blank) ? '_blank' : '' }}">
			                <picture>
			                    <source media="(max-width: 799px)" srcset="/uploads/{{ $slide->imagen_movil ?? $slide->imagen }}" class="w-100">
			                    <source media="(min-width: 800px)" srcset="/uploads/{{ $slide->imagen }}" class="w-100">
			                    <img src="/uploads/{{ $slide->imagen }}" alt="" class="w-100">
			                </picture>
			            </a>
			        </div>
			    @endforeach
		    </div>
		    <a class="carousel-control-prev" href="#sliderPrincipal" role="button" data-slide="prev">
		        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		        <span class="sr-only">Previous</span>
		    </a>
		    <a class="carousel-control-next" href="#sliderPrincipal" role="button" data-slide="next">
		        <span class="carousel-control-next-icon" aria-hidden="true"></span>
		        <span class="sr-only">Next</span>
		    </a>
		</div>
	@endif


	<section class="padding">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
					<h3> <span class="h1 gris text-uppercase f800 mb-4 editable" data-key="decadas" data-group="home">{!! trans('home.decadas') !!}</span> <span class="d-block text-center gris text-uppercase h5 editable" data-key="home_produciendo" data-group="home">{!! trans('home.home_produciendo') !!}</span></h3>
					<img src="/site/img/mr-lucky-01.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
					<h3><span class="h1 gris text-uppercase f800 mb-4 editable" data-key="control" data-group="home">{!! trans('home.control') !!}</span> <span class="d-block text-center gris text-uppercase h5 editable" data-key="ciclo_agricola" data-group="home">{!! trans('home.ciclo_agricola') !!}</span></h3>
					<img src="/site/img/mr-lucky-02.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-4 mb-4 mb-md-0 text-center">
					<h3><span class="h1 gris text-uppercase f800 mb-4 editable" data-key="mas_de" data-group="home">{!! trans('home.mas_de') !!}</span> <span class="d-block text-center gris text-uppercase h5 editable" data-key="somos_parte" data-group="home">{!! trans('home.somos_parte') !!}</span></h3>
					<img src="/site/img/mr-lucky-03.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
			</div>
		</div>
	</section>
	<img src="/site/img/campo-01.jpg" class="img-fluid w-100" loading="lazy" alt="">
	<section class="padding">
		<div class="container">
			<div class="m400 mx-auto">
				<p class="text-center azul-marino editable" data-key="mucho_mas" data-group="home">
					{!! trans('home.mucho_mas') !!}
				</p>
			</div>
			<div class="row mt-4 text-center">
				<div class="col-6 col-md-3">
					<img src="/site/img/icons/dedicacion.png" class="img-fluid mb-3" loading="lazy" alt="">
					<p class="gris editable" data-key="dedicacion" data-group="home">
						{!! trans('home.dedicacion') !!}
					</p>
				</div>
				<div class="col-6 col-md-3">
					<img src="/site/img/icons/cuidado.png" class="img-fluid mb-3" loading="lazy" alt="">
					<p class="gris editable" data-key="cuidado" data-group="home">
						{!! trans('home.cuidado') !!}
					</p>
				</div>
				<div class="col-6 col-md-3">
					<img src="/site/img/icons/pasion.png" class="img-fluid mb-3" loading="lazy" alt="">
					<p class="gris editable" data-key="pasion" data-group="home">
						{!! trans('home.pasion') !!}
					</p>
				</div>
				<div class="col-6 col-md-3">
					<img src="/site/img/icons/compasion.png" class="img-fluid mb-3" loading="lazy" alt="">
					<p class="gris editable" data-group="home" data-key="compasion">
						{!! trans('home.compasion') !!}
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section-30">
		<div class="container-fluid px-0">
			<div class="info text-center p-4 bg-azul-marino">
				<img src="/site/img/anos.png" class="img-fluid mb-3" loading="lazy" alt="">
				<div class="m400 mx-auto">
					<h5 class="text-white my-2 pacifico editable" data-key="durante" data-group="home">{!! trans('home.durante') !!}</h5>
					<p class="text-white editable" data-key="estos_valores" data-group="home">
						{!! trans('home.estos_valores') !!}
					</p>
				</div>
				<img src="/site/img/logo-blanco.png" class="img-fluid mb-3" loading="lazy" alt="">
			</div>
			<img src="/site/img/lechugas.jpg" class="img-fluid w-100" loading="lazy" alt="">
		</div>
	</section>

	<section class="section-categorias pt-4">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-4">
					<a href="#.">
						<img src="/site/img/{{ (App::currentLocale() == 'es') ? 'categorias' : 'categories' }}-01.jpg" alt="" class="img-fluid w-100" loading="lazy">
					</a>
				</div>
				<div class="col-12 col-sm-6 mb-4">
					<a href="#.">
						<img src="/site/img/{{ (App::currentLocale() == 'es') ? 'categorias' : 'categories' }}-02.jpg" alt="" class="img-fluid w-100" loading="lazy">
					</a>
				</div>
				<div class="col-12 col-sm-6 mb-4">
					<a href="#.">
						<img src="/site/img/{{ (App::currentLocale() == 'es') ? 'categorias' : 'categories' }}-03.jpg" alt="" class="img-fluid w-100" loading="lazy">
					</a>
				</div>
				<div class="col-12 col-sm-6 mb-4">
					<a href="#.">
						<img src="/site/img/{{ (App::currentLocale() == 'es') ? 'categorias' : 'categories' }}-04.jpg" alt="" class="img-fluid w-100" loading="lazy">
					</a>
				</div>
				<div class="col-12 col-sm-6 mb-4">
					<a href="#.">
						<img src="/site/img/{{ (App::currentLocale() == 'es') ? 'categorias' : 'categories' }}-05.jpg" alt="" class="img-fluid w-100" loading="lazy">
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-azul-marino py-5">
		<div class="container">
			<div class="m800 mx-auto">
				<h2 class="text-white text-center text-uppercase editable" data-kye="sistema_titulo" data-group="home">{!! trans('home.sistema_titulo') !!}</h2>
				<p class="m-0 text-white text-center editable" data-key="sistema_text" data-group="home">
					{!! trans('home.sistema_text') !!}
				</p>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-12 col-md-4">
					<img src="/site/img/proceso-01.jpg" class="img-fluid mb-4" loading="lazy" alt="">
					<img src="/site/img/proceso-02.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-8 d-flex align-items-center">
					<div class="row text-center py-4">
						<div class="col-6 col-md-4 mb-4">
 							<img src="/site/img/icons/01.png" class="img-fluid mb-2" loading="lazy" alt="">
							<h5 class="verde f600 text-uppercase editable" data-key="campo" data-group="home">{!! trans('home.campo') !!}</h5>
						</div>
						<div class="col-6 col-md-4 mb-4">
							<img src="/site/img/icons/02.png" class="img-fluid mb-2" loading="lazy" alt="">
							<h5 class="verde f600 text-uppercase editable" data-key="siembra" data-group="home">{!! trans('home.siembra') !!}</h5>
						</div>
						<div class="col-6 col-md-4 mb-4">
							<img src="/site/img/icons/03.png" class="img-fluid mb-2" loading="lazy" alt="">
							<h5 class="verde f600 text-uppercase editable" data-key="cosecha" data-group="home">{!! trans('home.cosecha') !!}</h5>
						</div>
						<div class="col-6 col-md-4 mb-4">
							<img src="/site/img/icons/04.png" class="img-fluid mb-2" loading="lazy" alt="">
							<h5 class="verde f600 text-uppercase editable" data-key="transporte" data-group="home">{!! trans('home.transporte') !!}</h5>
						</div>
						<div class="col-6 col-md-4 mb-4">
							<img src="/site/img/icons/05.png" class="img-fluid mb-2" loading="lazy" alt="">
							<h5 class="verde f600 text-uppercase editable" data-key="empaque" data-group="home">{!! trans('home.empaque') !!}</h5>
						</div>
						<div class="col-6 col-md-4 mb-4">
							<img src="/site/img/icons/06.png" class="img-fluid mb-2" loading="lazy" alt="">
							<h5 class="verde f600 text-uppercase editable" data-key="distribucion" data-group="home">{!! trans('home.distribuicion') !!}</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-naranja py-5">
		<div class="container">
			<div class="m400 mx-auto">
				<p class="m-0 azul-marino text-center h5 f300 editable" data-key="resultado" data-group="home">
					{!! trans('home.resultado') !!}
				</p>
			</div>
		</div>
	</section>

	<section class="padding">
		<div class="container">
			<div class="m500 mx-auto text-center">
				<img src="/site/img/logo.png" alt="" class="img-fluid mb-4" loading="lazy">
				<p class="azul-marino editable" data-key="certificados" data-group="home">
					{!! trans('home.certificados') !!}
				</p>
			</div>
			<div class="my-4 m700 mx-auto">
				<div class="row text-center">
					<div class="col-7 col-md">
						<a href="/site/certificaciones/ccof.pdf" target="_blank">
							<img src="/site/img/certificaciones/01.jpg" class="img-fluid" loading="lazy" alt="">
						</a>
					</div>
					<div class="col-7 col-md">
						<a href="/site/certificaciones/c-tpat.pdf" target="_blank">
							<img src="/site/img/certificaciones/02.jpg" class="img-fluid" loading="lazy" alt="">
						</a>
					</div>
					<div class="col-7 col-md">
						<a href="/site/certificaciones/kosher.pdf" target="_blank">
							<img src="/site/img/certificaciones/03.jpg" class="img-fluid" loading="lazy" alt="">
						</a>
					</div>
					<div class="col-7 col-md">
						<a href="/site/certificaciones/sqf.pdf" target="_blank">
							<img src="/site/img/certificaciones/04.jpg" class="img-fluid" loading="lazy" alt="">
						</a>
					</div>
					<div class="col-7 col-md">
						<a href="/site/certificaciones/smeta.pdf" target="_blank">
							<img src="/site/img/certificaciones/05.jpg" class="img-fluid" loading="lazy" alt="">
						</a>
					</div>
                    <div class="col-7 col-md">
    					<a href="" target="_blank">
							<img src="/site/img/certificaciones/07.jpg" class="img-fluid" loading="lazy" alt="">
						</a>
					</div>
				</div>
				<div class="mt-5 text-center">
					<a href="{{ route( App::currentLocale() . '.compromiso') }}#sa" class="button bg-azul-marino text-white f600 text-uppercase editable" data-key="seguridad_alimentaria" data-group="home">
						{!! trans('home.seguridad_alimentaria') !!}
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-white">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-12 col-md-6">
					<img src="/site/img/sustentabilidad-01.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 bg-verde text-white p-4 d-flex align-items-center justify-content-center">
					<div class="text-center">
						<p class="text-white h5 f300 mb-5 editable" data-key="por_goteo" data-group="home">
							{!! trans('home.por_goteo') !!}
						</p>
						<a href="{{ route( App::currentLocale() . '.compromiso') }}" class="button text-white text-uppercase" style="background: rgba(0, 0, 0, .2);">
							{!! trans('web.menu_compromiso_text') !!}
						</a>
					</div>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12 col-md-6 order-md-2">
					<img src="/site/img/sustentabilidad-02.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 bg-verde-claro text-white p-4 d-flex align-items-center justify-content-center order-md-1">
					<div class="text-center">
						<p class="text-white h5 f300 mb-5 editable" data-key="implementacion_minima" data-group="home">
							{!! trans('home.implementacion_minima') !!}
						</p>
						<a href="{{ route( App::currentLocale() . '.compromiso') }}#sustentabilidad" class="button text-white text-uppercase" style="background: rgba(0, 0, 0, .2);">
							{!! trans('home.sustentabilidad') !!}
						</a>
					</div>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12 col-md-6">
					<img src="/site/img/compromiso.jpg" class="img-fluid" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 bg-azul text-white p-4 d-flex align-items-center justify-content-center">
					<div class="text-center">
						<p class="text-white h5 f300 mb-5 editable" data-key="familia" data-group="home">
							{!! trans('home.familia') !!}
						</p>
						<a href="{{ route( App::currentLocale() . '.compromiso') }}#responsabilidad" class="button text-white text-uppercase" style="background: rgba(0, 0, 0, .2);">
							{!! trans('home.responsabilidad') !!}
						</a>
					</div>
				</div>
			</div>

		</div>
	</section>
	<section class="section-video d-flex align-items-center justify-content-center">
		<div class="container text-center">
			<span class="text-white h5 editable" data-key="dia_regular" data-group="home">{!! trans('home.dia_regular') !!} </span>
			<img src="/site/img/logo-blanco.png" class="img-fluid px-4 py-4 py-md-0 d-block mx-auto d-md-inline-block" loading="lazy" alt="">
			<a href="https://vimeo.com/826020224/b95a8036f4" target="_blank" class="btn-video">
				{!! trans('home.ver_video') !!} <i class="fa fa-play"></i>
			</a>
		</div>
	</section>

	@if($recetas->count())
		<section class="section-recetas bg-white padding">
			<div class="container">
				<div class="text-center">
					<img src="/site/img/icons/recetas.png" class="img-fluid" loading="lazy" alt="">
					<h2 class="my-4 azul-marino pacifico f300 editable" data-key="recetas_titulo" data-group="home">{!! trans('home.recetas_titulo') !!}</h2>
					<p class="azul-marino editable" data-key="recetas_saludables" data-group="home">
						{!! trans('home.recetas_saludables') !!}
					</p>
					<div class="row mt-5 recetas">
						@foreach($recetas as $receta)
							<div class="col-12 col-md-6 col-lg-4 mb-4">
								<a href="{{ route( App::currentLocale() . '.receta', ['slug' => $receta->slug] ) }}">
									<div class="receta">
										<div class="info">
											@if($receta->imagen)
												<img src="/uploads/{{ $receta->imagen }}" class="img-fluid w-100" loading="lazy" alt="">
											@endif
											@if($receta->imagen)
												<span class="tiempo">{{ $receta->tiempo }} min <i class="fa fa-clock-o"></i></span>
											@endif
										</div>
										<h5 class="gris mt-3">{{ $receta->titulo }}</h5>
									</div>
								</a>
							</div>
						@endforeach
					</div>
					<div class="text-center">
						<a href="{{ route( App::currentLocale() . '.recetas') }}" class="button bg-verde text-white mt-5 d-inline-block small">
							{!! trans('home.ver_todas') !!}
						</a>
					</div>
				</div>
			</div>
		</section>
	@endif

	@if($blogs->count())
		<section class="section-blog padding">
			<div class="container">
				<h2 class="text-center rojo pacifico display-4">Blog</h2>

				<div class="row posts mt-5">

					@foreach($blogs as $blog)
						<div class="col-12 col-md-4">
							<div class="post shadow">
								@if($blog->imagen)
									<img src="/uploads/{{ $blog->imagen }}" alt="" class="img-fluid w-100" loading="lazy">
								@endif
								<div class="py-2 px-3">
									<p class="my-2 gris">
										{{ $blog->titulo ?? '' }}
									</p>
									<a href="{{ route( App::currentLocale() . '.post', ['slug' => $blog->slug] ) }}" class="btn btn-link small px-0">Ver más</a>
								</div>
							</div>
						</div>
					@endforeach

				</div>
				<div class="text-center pt-3">
					<i class="fa fa-caret-up rojo"></i>
					<p class="rojo text-uppercase mb-0">
						{!! trans('home.mas_reciente') !!}
					</p>
				</div>
			</div>
		</section>
	@endif
@stop

@section('customCSS')
	@parent
@stop

@section('customJS')
	@parent
	<script>
		$(function(){



		});
	</script>
@stop