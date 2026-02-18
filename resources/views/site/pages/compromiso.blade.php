@extends('site.layouts.master')
@php
    $active = 'compromiso';
@endphp

@section('page')
    @if(App::currentLocale() == 'es')
        <img src="/site/img/banner-compromiso.jpg" loading="lazy" class="img-fluid w-100">
    @else
        <img src="/site/img/banner-compromiso-en.jpg" loading="lazy" class="img-fluid w-100">
    @endif

    <section class="padding bg-gris-claro">
        <div class="container">
            <div class="m400 mx-auto text-center">
                <p class="azul-marino editable" data-key="nuestra_prioridad" data-group="compromiso">
                    {!! trans('compromiso.nuestra_prioridad') !!}
                </p>

			</div>
			<div class="m500 mx-auto text-center">
				<p class="azul-marino editable" data-key="nuestro_compromiso" data-group="compromiso">
					{!! trans('compromiso.nuestro_compromiso') !!}
				</p>
			</div>

			<div class="mt-5">
				<div class="row">
					<div class="col-12 col-md-5">
						<p class="gris editable" data-key="marca_certificada" data-group="compromiso">
							{!! trans('compromiso.marca_certificada') !!}
						</p>
						<ul class="list-unstyled">
							<li class="mb-3">
								<img src="/site/img/icons/seguro.png" alt="" class="mr-2">
								<span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="siembra">{!! trans('compromiso.siembra') !!}</span>
							</li>
							<li class="mb-3">
								<img src="/site/img/icons/seguro.png" alt="" class="mr-2">
								<span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="cosecha">{!! trans('compromiso.cosecha') !!}</span>
							</li>
							<li class="mb-3"><img src="/site/img/icons/seguro.png" alt="" class="mr-2"><span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="transporte">{!! trans('compromiso.transporte') !!}</span></li>
							<li class="mb-3"><img src="/site/img/icons/seguro.png" alt="" class="mr-2"><span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="empaque">{!! trans('compromiso.empaque') !!}</span></li>
							<li class="mb-3"><img src="/site/img/icons/seguro.png" alt="" class="mr-2"><span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="distribucion">{!! trans('compromiso.distribucion') !!}</span></li>
						</ul>
					</div>
					<div class="col-12 col-md-7">
						<div class="bg-white shadow p-4 rounded">
							<h4 class="azul-marino f600 text-uppercase editable" data-group="compromiso" data-key="certificaciones">{!! trans('compromiso.certificaciones') !!}</h4>
							<p class="my-4 editable" data-group="compromiso" data-key="certificaciones_text">
								{!! trans('compromiso.certificaciones_text') !!}
							</p>
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
    					            <a href="/site/certificaciones/sqf.pdf" target="_blank">
							        <img src="/site/img/certificaciones/04.jpg" class="img-fluid" loading="lazy" alt="">
						            </a>
					            </div>
					            <div class="col-7 col-md">
						            <a href="/site/certificaciones/kosher.pdf" target="_blank">
							        <img src="/site/img/certificaciones/03.jpg" class="img-fluid" loading="lazy" alt="">
						            </a>
					            </div>
                                <div class="col-7 col-md">
    					            <a href="/site/certificaciones/FTUSA_CRT.pdf" target="_blank">
							        <img src="/site/img/certificaciones/06.jpg" class="img-fluid" loading="lazy" alt="">
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
					    </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-azul-marino padding">
		<div class="container">
			<div class="m600 mx-auto bg-verde text-white p-4 rounded text-uppercase text-center" style="margin-top: -130px; margin-bottom: 40px;">
				{!! trans('compromiso.sistema_calidad') !!}
			</div>
			<div id="qualityControl" class="row">
				<div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="0">
					<img src="/site/img/icons/calidad-01.png" loading="lazy" alt="" class="img-fluid">
					<div class="text-white text-uppercase f600">{!! trans('compromiso.campo') !!}</div>
				</div>
				<div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="1">
					<img src="/site/img/icons/calidad-02.png" loading="lazy" alt="" class="img-fluid">
					<div class="text-white text-uppercase f600">{!! trans('compromiso.siembra_titulo') !!}</div>
				</div>
				<div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="2">
					<img src="/site/img/icons/calidad-03.png" loading="lazy" alt="" class="img-fluid">
					<div class="text-white text-uppercase f600">{!! trans('compromiso.cosecha') !!}</div>
				</div>
				<div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="3">
					<img src="/site/img/icons/calidad-04.png" loading="lazy" alt="" class="img-fluid">
					<div class="text-white text-uppercase f600">{!! trans('compromiso.cadena_frio') !!}</div>
				</div>
				<div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="4">
					<img src="/site/img/icons/calidad-05.png" loading="lazy" alt="" class="img-fluid">
					<div class="text-white text-uppercase f600">{!! trans('compromiso.empaque_titulo') !!}</div>
				</div>
				<div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="5">
					<img src="/site/img/icons/calidad-06.png" loading="lazy" alt="" class="img-fluid">
					<div class="text-white text-uppercase f600">{!! trans('compromiso.distribucion_titulo') !!}</div>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-gris-claro padding">
		<div class="container">
			<div id="qualityControlSlider" class="carousel slide" data-ride="false">
			    <ol class="carousel-indicators">
			        <li data-target="#qualityControlSlider" data-slide-to="0" class="active"></li>
			        <li data-target="#qualityControlSlider" data-slide-to="1"></li>
			        <li data-target="#qualityControlSlider" data-slide-to="2"></li>
			        <li data-target="#qualityControlSlider" data-slide-to="3"></li>
			        <li data-target="#qualityControlSlider" data-slide-to="4"></li>
			        <li data-target="#qualityControlSlider" data-slide-to="5"></li>
			    </ol>
			    <div class="carousel-inner">
			        <div class="carousel-item active">
			            <div class="row">
							<div class="col-12 col-md-7">
								<img src="/site/img/compromiso-campo.png" class="img-fluid" alt="">
							</div>
							<div class="col-12 col-md-5 d-flex align-items-center">
								<div>
									<h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="campo">{!! trans('compromiso.campo') !!}</h3>
									<div class="editable" data-group="compromiso" data-key="campo_text">
										{!! trans('compromiso.campo_text') !!}
									</div>
								</div>
							</div>
						</div>
			        </div>
			        <div class="carousel-item">
			            <div class="row">
							<div class="col-12 col-md-7 order-md-2">
								<img src="/site/img/compromiso-siembra.jpg" class="img-fluid" alt="">
							</div>
							<div class="col-12 col-md-5 d-flex align-items-center">
								<div>
									<h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="siembra_titulo">{!! trans('compromiso.siembra_titulo') !!}</h3>
									<div class="editable" data-group="compromiso" data-key="siembra_text">
										{!! trans('compromiso.siembra_text') !!}
									</div>
								</div>
							</div>
						</div>
			        </div>
			        <div class="carousel-item">
			            <div class="row">
							<div class="col-12 col-md-7">
								<img src="/site/img/compromiso-cosecha.jpg" class="img-fluid" alt="">
							</div>
							<div class="col-12 col-md-5 d-flex align-items-center">
								<div>
									<h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="cosecha">{!! trans('compromiso.cosecha') !!}</h3>
									<div class="editable" data-group="compromiso" data-key="cosecha_text">
										{!! trans('compromiso.cosecha_text') !!}
									</div>
								</div>
							</div>
						</div>
			        </div>
			        <div class="carousel-item">
			            <div class="row">
							<div class="col-12 col-md-7 order-md-2">
								<img src="/site/img/compromiso-transporte.jpg" class="img-fluid" alt="">
							</div>
							<div class="col-12 col-md-5 d-flex align-items-center">
								<div>
									<h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="cadena_frio">{!! trans('compromiso.cadena_frio') !!}</h3>
									<div class="editable" data-group="compromiso" data-key="cadena_frio_text">
										{!! trans('compromiso.cadena_frio_text') !!}
									</div>
								</div>
							</div>
						</div>
			        </div>
			        <div class="carousel-item">
			            <div class="row">
							<div class="col-12 col-md-7">
								<img src="/site/img/compromiso-empaque.jpg" class="img-fluid" alt="">
							</div>
							<div class="col-12 col-md-5 d-flex align-items-center">
								<div>
									<h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="empaque_titulo">{!! trans('compromiso.empaque_titulo') !!}</h3>
									<div class="editable" data-group="compromiso" data-key="empaque_text">
										{!! trans('compromiso.empaque_text') !!}
									</div>
								</div>
							</div>
						</div>
			        </div>
			        <div class="carousel-item">
			            <div class="row">
							<div class="col-12 col-md-7 order-md-2">
								<img src="/site/img/compromiso-distribucion.jpg" class="img-fluid" alt="">
							</div>
							<div class="col-12 col-md-5 d-flex align-items-center">
								<div>
									<h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="distribucion_titulo">{!! trans('compromiso.distribucion_titulo') !!}</h3>
									<div class="editable" data-group="compromiso" data-key="distribucion_text">
										{!! trans('compromiso.distribucion_text') !!}
									</div>
								</div>
							</div>
						</div>
			        </div>
			    </div>
			</div>
		</div>
	</section>

	<section id="responsabilidad" class="padding">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-12 col-md-3">
					<h3 class="amarillo text-uppercase text-right f600 editable" data-group="compromiso" data-key="responsabilidad_social">{!! trans('compromiso.responsabilidad_social') !!}</h3>
				</div>
				<div class="col-12 col-md-6">
					<p class="azul-marino editable" data-group="compromiso" data-key="social_text">
						{!! trans('compromiso.social_text') !!}
					</p>
				</div>
				<div class="col-12 col-md-3">
					<img src="/site/img/icons/responsabilidad-social.png" loading="lazy" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</section>

	<section class="padding" style="background-color: #F0F0EE;">
		<div class="container">
			<div class="m400 mx-auto">
				<p class="text-center editable" data-group="compromiso" data-key="certificacion_smeta">
					{!! trans('compromiso.certificacion_smeta') !!}
				</p>
			</div>
			<div id="smetaSlider" class="carousel slide rounded mt-4" data-ride="carousel">
			    <div class="carousel-inner">
			        <div class="carousel-item active">
			            <img class="d-block w-100" src="/site/img/slides/slider-smeta-01{{ (App::currentLocale() == 'en') ? '_en' : '' }}.jpg">
			        </div>
			        <div class="carousel-item">
			            <img class="d-block w-100" src="/site/img/slides/slider-smeta-02{{ (App::currentLocale() == 'en') ? '_en' : '' }}.jpg">
			        </div>
			        <div class="carousel-item">
			            <img class="d-block w-100" src="/site/img/slides/slider-smeta-03{{ (App::currentLocale() == 'en') ? '_en' : '' }}.jpg">
			        </div>
			        <div class="carousel-item">
			            <img class="d-block w-100" src="/site/img/slides/slider-smeta-04{{ (App::currentLocale() == 'en') ? '_en' : '' }}.jpg">
			        </div>
			        <div class="carousel-item">
			            <img class="d-block w-100" src="/site/img/slides/slider-smeta-05{{ (App::currentLocale() == 'en') ? '_en' : '' }}.jpg">
			        </div>
			    </div>
			    <a class="carousel-control-prev" href="#smetaSlider" role="button" data-slide="prev">
			        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			        <span class="sr-only">Previous</span>
			    </a>
			    <a class="carousel-control-next" href="#smetaSlider" role="button" data-slide="next">
			        <span class="carousel-control-next-icon" aria-hidden="true"></span>
			        <span class="sr-only">Next</span>
			    </a>
			</div>
			<div class="mt-5">
				<div class="text-center">
					<img src="/site/img/logo.png" loading="lazy" alt="">
					<h3 class="h4 azul-marino text-uppercase mt-4 editable" data-group="compromiso" data-key="algunas_practicas">{!! trans('compromiso.algunas_practicas')!!}</h3>

					<div class="practicas text-center mt-5" data-entrance="from-top" data-entrance-delay="100">
						<div class="item">
							<img src="/site/img/practicas/01.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_01">
								{!! trans('compromiso.social_01') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/02.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_02">
								{!! trans('compromiso.social_02') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/03.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_03">
								{!! trans('compromiso.social_03') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/04.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_04">
								{!! trans('compromiso.social_04') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/05.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_05">
								{!! trans('compromiso.social_05') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/06.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_06">
								{!! trans('compromiso.social_06') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/07.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_07">
								{!! trans('compromiso.social_07') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/08.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_08">
								{!! trans('compromiso.social_08') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/09.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_09">
								{!! trans('compromiso.social_09') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/10.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_10">
								{!! trans('compromiso.social_10') !!}
							</p>
						</div>
						<div class="item">
							<img src="/site/img/practicas/11.png" class="img-fluid d-inline-block">
							<p class="m300 mx-auto mt-3 editable" data-group="compromiso" data-key="social_11">
								{!! trans('compromiso.social_11') !!}
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="sustentabilidad" class="padding padding bg-azul-marino">
		<div class="container">
			<div class="m800 mx-auto">
				<h2 class="text-center verde pacifico editable" data-group="compromiso" data-key="sustentabilidad">{!! trans('compromiso.sustentabilidad') !!}</h2>
				<p class="text-white text-center mt-3 editable" data-group="compromiso" data-key="sustentabilidad_text">
					{!! trans('compromiso.sustentabilidad_text') !!}
				</p>
			</div>
		</div>
	</section>

	<section>
		<div class="container-fluid px-0">
			<div class="row no-gutters">
				<div class="col-12 col-md-6 order-md-2">
					<img src="/site/img/practicas-sustentables-01.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #86b711;">
					<div class="p-4 m600 mx-auto">
						<span class="d-inline-block p-2 text-white bg-azul-marino mb-3 editable" data-group="compromiso" data-key="nuestras_practicas">{!! trans('compromiso.nuestras_practicas') !!}</span>
						<h3 class="text-uppercase f600 mb-4 editable" data-group="compromiso" data-key="rotacion_campo">{!! trans('compromiso.rotacion_campo') !!}</h3>

						<div class="text-white editable" data-group="compromiso" data-key="rotacion_campo_text">
							{!! trans('compromiso.rotacion_campo_text') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-12 col-md-6">
					<img src="/site/img/practicas-sustentables-02.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #6b5a3f;">
					<div class="p-4 m600 mx-auto">
						<h3 class="text-uppercase f600 mb-4 amarillo editable" data-group="compromiso" data-key="riego_goteo">{!! trans('compromiso.riego_goteo') !!} </h3>
						<p class="text-white editable" data-group="compromiso" data-key="riego_goteo_text">
							{!! trans('compromiso.riego_goteo_text') !!}
						</p>
					</div>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-12 col-md-6 order-md-2">
					<img src="/site/img/practicas-sustentables-03.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #425f1b;">
					<div class="p-4 m600 mx-auto">
						<h3 class="text-uppercase f600 mb-4 amarillo editable" data-group="compromiso" data-key="agricultura_organica">{!! trans('compromiso.agricultura_organica') !!}</h3>
						<p class="text-white editable" data-group="compromiso" data-key="agricultura_organica_text">
							{!! trans('compromiso.agricultura_organica_text') !!}
						</p>
					</div>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-12 col-md-6">
					<img src="/site/img/practicas-sustentables-04.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #dec65d;">
					<div class="p-4 m600 mx-auto">
						<h3 class="text-uppercase f600 mb-4 editable" style="color:#cf7b04;" data-group="compromiso" data-key="programa_biologico">{!! trans('compromiso.programa_biologico') !!} </h3>
						<p class="text-white editable" data-group="compromiso" data-key="programa_biologico_text">
							{!! trans('compromiso.programa_biologico_text') !!}
						</p>
					</div>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-12 col-md-6 order-md-2">
					<img src="/site/img/practicas-sustentables-05.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #5a5a3d;">
					<div class="p-4 m600 mx-auto">
						<h3 class="text-uppercase f600 mb-4 editable" style="color: #a8bf19;" data-group="compromiso" data-key="composteo">{!! trans('compromiso.composteo') !!}</h3>
						<p class="text-white editable" data-group="compromiso" data-key="composteo_text">
							{!! trans('compromiso.composteo_text') !!}
						</p>
					</div>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-12 col-md-6">
					<img src="/site/img/practicas-sustentables-06.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #762412;">
					<div class="p-4 m600 mx-auto">
						<h3 class="text-uppercase f600 mb-4 editable" style="color:#cf7b04;" data-group="compromiso" data-key="empaque_reciclado">{!! trans('compromiso.empaque_reciclado') !!}</h3>
						<div class="editable" data-group="compromiso" data-key="empaque_reciclado_text">
							{!! trans('compromiso.empaque_reciclado_text') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-12 col-md-6 order-md-2">
					<img src="/site/img/practicas-sustentables-07.jpg" class="img-fluid w-100" loading="lazy" alt="">
				</div>
				<div class="col-12 col-md-6 d-flex align-items-center" style="background-color: #485a70;">
					<div class="p-4 m600 mx-auto">
						<h3 class="text-uppercase f600 mb-4 editable" style="color: #a8bf19;" data-group="compromiso" data-key="generacion_energia">{!! trans('compromiso.generacion_energia') !!}</h3>
						<p class="text-white editable" data-group="compromiso" data-key="generacion_energia_text">
							{!! trans('compromiso.generacion_energia_text') !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop

@section('customCSS')
	@parent
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
	<style>
		.slick-slider .slick-next:before{
			font-size: 30px;
			color: #003ca6;
		}
		.slick-slider .slick-prev:before{
			font-size: 30px;
			color: #003ca6;
		}
		.slick-dots li.slick-active button:before{
			color: #003ca6;
			font-size: 10px;
		}
		#qualityControl .item{ transform: scale(1); transition: all .3s; cursor: pointer }
		#qualityControl .item:hover{ transform: scale(1.2); transition: all .3s; }
		#qualityControlSlider .carousel-indicators{ bottom: -50px; }
		#qualityControlSlider .carousel-indicators li{ background-color: #003ca6; }
	</style>
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script>
		$(function(){

			/*----------  Prácticas  ----------*/
			$('.practicas').slick({
			  	dots: true,
			  	infinite: false,
			  	speed: 300,
			 	slidesToShow: 3,
			  	slidesToScroll: 3,
			  	autoplay: true,
			  	arrows: true,
			  	responsive: [
			    	{
			      		breakpoint: 962,
			      		settings: {
			       	 		slidesToShow: 2,
			        		slidesToScroll: 2
			      		}
			    	},
			    	{
			      		breakpoint: 800,
			      		settings: {
			        		slidesToShow: 1,
			        		slidesToScroll: 1,
			        		dots: true,
			        		arrows: false
			      		}
			    	}
			  ]
			});

		});
	</script>
@stop