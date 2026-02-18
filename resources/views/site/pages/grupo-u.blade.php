@extends('site.layouts.master')
@php
    $active = 'grupo-u';
@endphp

@section('page')
    <img src="/site/img/banner-grupo-u.jpg" loading="lazy" class="img-fluid w-100">

	<section class="section-somos padding pt-0 position-relative" style="background-color: #F0F0F0;">
		<div class="m800 mx-auto somos-text">
			<div class="somos bg-azul-marino text-white rounded p-3 text-center h5 f300 editable" data-key="pioneros" data-group="grupou">
				{!! trans('grupou.pioneros') !!}
			</div>
		</div>
		<div class="container">
			<div class="m500 mx-auto mb-4 mb-md-5">
				<h2 class="azul-marino text-center h4 f300 editable" data-key="comprometidos" data-group="grupou">{!! trans('grupou.comprometidos') !!}</h2>
			</div>
			<div class="row align-items-center">
				<div class="col-12 col-md-7 mb-4 mb-md-0">
					<p class="lila editable" data-key="ubicados" data-group="grupou">
						{!! trans('grupou.ubicados') !!}
					</p>
				</div>
				<div class="col-12 col-md-5">
                    @if(App::currentLocale() == 'es')
                        <img src="/site/img/ubicacion.png" class="img-fluid" loading="lazy" alt="">
		            @else
                        <img src="/site/img/ubicacion-en.png" class="img-fluid" loading="lazy" alt="">
		            @endif
				</div>
			</div>
		</div>
	</section>

	<img src="/site/img/vision.jpg" loading="lazy" class="img-fluid w-100">

	<section class="section-vision paddding bg-azul-claro py-5">
		<div class="container">
			<div class="m400 mx-auto">
				<h4 class="amarillo text-center pacifico editable" data-key="vision" data-group="grupou">{!! trans('grupou.vision') !!}</h4>
				<p class="text-white text-center editable" data-key="vision_text" data-group="grupou">
					{!! trans('grupou.vision_text') !!}
				</p>
			</div>
		</div>
	</section>

	<section class="section-comprometidos bg-gris-claro pb-5">
		<div class="m500 mx-auto p-3 rounded bg-white imagen">
			<img src="/site/img/comprometidos.jpg" class="img-fluid my-4 my-md-0" loading="lazy" alt="">
		</div>
		<div class="container">
			<div class="m400 mx-auto">
				<p class="azul-claro text-center mt-4 mt-md-0 editable" data-key="vision_text2" data-group="grupou">
					{!! trans('grupou.vision_text2') !!}
				</p>
			</div>

			<div class="row mt-4 mt-md-5">
				<div class="col-12 col-md-6 mb-4 mb-md-0">
					<div class="bg-naranja d-flex align-items-center justify-content-center rounded h-100">
						<div class="m400 p-4 text-center">
							<h4 class="amarillo pacifico mb-3 editable" data-key="mision" data-group="grupou">{!! trans('grupou.mision') !!}</h4>
							<p class="text-white editable" data-key="mision_text" data-group="grupou">
								{!! trans('grupou.mision_text') !!}
							</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="bg-verde d-flex align-items-center justify-content-center rounded h-100">
						<div class="m400 p-4 text-center">
							<h4 class="amarillo pacifico mb-3 editable" data-key="valores" data-group="grupou">{!! trans('grupou.valores') !!}</h4>
							<ul class="text-uppercase text-center m-0 p-0">
								<li class="text-white d-block editable" data-key="unidad" data-group="grupou">{!! trans('grupou.unidad') !!}</li>
								<li class="text-white d-block editable" data-key="respeto" data-group="grupou">{!! trans('grupou.respeto') !!}</li>
								<li class="text-white d-block editable" data-key="etica" data-group="grupou">{!! trans('grupou.etica') !!}</li>
								<li class="text-white d-block editable" data-key="innovacion" data-group="grupou">{!! trans('grupou.innovacion') !!}</li>
								<li class="text-white d-block editable" data-key="excelencia" data-group="grupou">{!! trans('grupou.excelencia') !!}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-numeralia bg-gris-claro py-5">
		<div class="container">
			<div class="row text-center">
				<div class="col-6 col-sm-4 col-lg-2 item mb-4 mb-lg-0">
					<div class="h2 editable" data-group="grupou" data-key="num_01">{!! trans('grupou.num_01') !!}</div>
					<p class="azul-marino editable" data-key="mexicana" data-group="grupou">
						{!! trans('grupou.mexicana') !!}
					</p>
				</div>
				<div class="col-6 col-sm-4 col-lg-2 item mb-4 mb-lg-0">
					<div class="count h2 azul-marino f600 editable" data-group="grupou" data-key="num_02">{!! trans('grupou.num_02') !!}</div>
					<p class="azul-marino editable" data-key="colaboradores" data-group="grupou">
						{!! trans('grupou.colaboradores') !!}
					</p>
				</div>
				<div class="col-6 col-sm-4 col-lg-2 item mb-4 mb-lg-0">
					<div class="count h2 azul-marino f600 editable" data-group="grupou" data-key="num_03">{!! trans('grupou.num_03') !!}</div>
					<p class="azul-marino editable" data-key="invernaderos" data-group="grupou">
						{!! trans('grupou.invernaderos') !!}
					</p>
				</div>
				<div class="col-6 col-sm-4 col-lg-2 item mb-4 mb-lg-0">
					<div class="count h2 azul-marino f600 editable" data-group="grupou" data-key="num_04">{!! trans('grupou.num_04') !!}</div>
					<p class="azul-marino editable" data-key="composta" data-group="grupou">
						{!! trans('grupou.composta') !!}
					</p>
				</div>
				<div class="col-6 col-sm-4 col-lg-2 item mb-4 mb-lg-0">
					<div class="h2 editable" data-group="grupou" data-key="num_05">{!! trans('grupou.num_05') !!}</div>
					<p class="azul-marino editable" data-key="campos" data-group="grupou">
						{!! trans('grupou.campos') !!}
					</p>
				</div>
				<div class="col-6 col-sm-4 col-lg-2 item mb-4 mb-lg-0">
					<div class="count h2 azul-marino f600 editable" data-group="grupou" data-key="num_06">{!! trans('grupou.num_06') !!}</div>
					<p class="azul-marino editable" data-key="years" data-group="grupou">
						{!! trans('grupou.years') !!}
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="compromiso-social padding">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6 mb-4 mb-md-0">
					<p class="azul-marino editable" data-key="empresas" data-group="grupou">
						{!! trans('grupou.empresas') !!}
					</p>
					<div class="text-center text-lg-right mt-5">
						<img src="/site/img/compromiso-social-01.jpg" loading="lazy" alt="" class="img-fluid">
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="text-center text-lg-left mb-5">
						<img src="/site/img/compromiso-social-02.jpg" loading="lazy" alt="" class="img-fluid">
					</div>
					<h4 class="azul-claro f600 editable" data-key="impulsamos" data-group="grupou">{!! trans('grupou.impulsamos') !!}</h4>
					<ul>
						<li class="azul-marino editable" data-key="mejora" data-group="grupou">{!! trans('grupou.mejora') !!}</li>
						<li class="azul-marino editable" data-key="apoyo" data-group="grupou">{!! trans('grupou.apoyo') !!}</li>
						<li class="azul-marino editable" data-key="proyectos" data-group="grupou">{!! trans('grupou.proyectos') !!}</li>
						<li class="azul-marino editable" data-key="salud" data-group="grupou">{!! trans('grupou.salud') !!}</li>
						<li class="azul-marino editable" data-key="empresa_limpia" data-group="grupou">{!! trans('grupou.empresa_limpia') !!}</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="section-empresas bg-azul-marino py-5">
		<div class="container">
			<div class="d-flex justify-content-center align-items-center mb-4">
				<h2 class="h3 verde text-uppercase text-center f600 mb-0 pb-0 editable"  data-key="empresas_forman" data-group="grupou">{!! trans('grupou.empresas_forman') !!}</h2>
				<img src="/site/img/icon.png" loading="lazy" class="ml-3">
			</div>

			<div class="row mt-5">
				<div class="col-12 col-md-6 mb-4">
					<div class="empresa rounded">
						<h5 class="text-uppercase">Invernaderos Arroyo, S.P.R. de R.L.</h5>
						<p class="text-white small">
							Carretera Panamericana km. 291-3 <br>
							Colonia La Fortaleza Cortazar, Guanajuato <br>
							C.P. 38481 <br>
							Tel. (411) 155-0949 / 155-0950 <br>
							Contacto: ludwig@grupou.mx
						</p>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4">
					<div class="empresa rounded">
						<h5 class="text-uppercase">Aguilares, S.P.R. de R.L.</h5>
						<p class="text-white small">
							Rancho Aguilares S/N. <br>
							Municipio de Salamanca, Gto. <br>
							C.P. 38240 <br>
							Tel. (411) 155-0949 / 155-0950 Ext. 153 <br>
						</p>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4">
					<div class="empresa rounded">
						<h5 class="text-uppercase">Covemex, S.A. de C.V.</h5>
						<p class="text-white small">
							Carretera Panamericana km 254 <br>
							Colonia Rancho Nuevo <br>
							Apaseo El Grande, Guanajuato <br>
							C.P. 38160 <br>
							Tel. (461) 615-3658 / 615- 3513 <br>
							Contacto: covemex@covemex.com
						</p>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4">
					<div class="empresa rounded">
						<h5 class="text-uppercase">Comercializadora GAB, S.A. de C.V.</h5>
						<p class="text-white small">
							Carretera Panamericana km. 5<br>
							Colonia Rancho Grande <br>
							Irapuato, Guanajuato <br>
							C.P. 36544 <br>
							Tel. (462) 626-2663 <br>
							Contacto: info@mrlucky.com.mx
						</p>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4">
					<div class="empresa rounded">
						<h5 class="text-uppercase">Transportes GAB, S.A. de C.V.</h5>
						<p class="text-white small">
							Carretera Panamericana km 254 <br>
							Colonia Rancho Nuevo <br>
							Apaseo El Grande, Guanajuato <br>
							C.P. 38160 <br>
							Tel. (461) 615-3658 / 615- 3513 <br>
							Contacto: logistica@tgab.com.mx
						</p>
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