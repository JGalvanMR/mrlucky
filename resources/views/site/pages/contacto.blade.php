@extends('site.layouts.master')
@php
    $active = 'contacto';
@endphp

@section('page')
    @if(App::currentLocale() == 'es')
        <img src="/site/img/banner-contacto.jpg" loading="lazy" class="img-fluid w-100">
    @else
        <img src="/site/img/banner-contacto-en.jpg" loading="lazy" class="img-fluid w-100">
    @endif

    <section class="section-contacto py-5">
        <div class="container">
            <div class="row">
    			<div class="col-12 col-md-6 mb-4 mb-md-2">
					<p class="azul-marino editable" data-group="contacto" data-key="form_text">
						{!! trans('contacto.form_text') !!}
					</p>

					<form action="{{ route(App::currentLocale().'.contacto_enviar') }}" method="post" data-toggle="validator" data-disable="false" data-focus="false">
                    	{{ csrf_field() }}
						<input type="hidden" name="website" value="" />
						<div class="form-group">
							<select name="area" class="form-control" data-error="{!! trans('contacto.area_error') !!}" required>
								<option value="">{!! trans('contacto.area_label') !!}</option>
                        <option value="rosa.rodriguez@mrlucky.com.mx">{!! trans('contacto.capitalhumano_label') !!}</option>
							{{-- <option value="lescobar@brandhouse.com.mx">Capital Humano 2</option> --}}
								<option value="mrhernandez@mrlucky.com.mx">{!! trans('contacto.calidad') !!}</option>
								<option value="comprasmp@mrlucky.com.mx,comprasmateriales@mrlucky.com.mx">{!! trans('contacto.proveedores') !!}</option>
								<option value="">{!! trans('contacto.mantenimiento') !!}</option>
								<option value="mercadotecnia@mrlucky.com.mx">{!! trans('contacto.mercadotecnia') !!}</option>
								<option value="msamano@mrluccky.com.mx">{!! trans('contacto.capitalhumano_label') !!}</option>
								<option value="sistemas@mrlucky.com.mx">{!! trans('contacto.sistemas') !!}</option>
								<option value="orders@mrlucky.com.mx">{!! trans('contacto.ventasexportacion') !!}</option>
								<option value="">{!! trans('contacto.ventasnacional') !!}</option>
							</select>
							<small class="help-block with-errors"></small>
							 {{-- Copia a: ricardo.cortes@mrlucky.com.mxmusabiaga@mrlucky.com.mxadrian.ortega@mrlucky.com.mx --}}
						</div>
						<div class="form-group">
							<input type="text" name="nombre" class="form-control" placeholder="{!! trans('contacto.nombre_label') !!}" data-error="{!! trans('contacto.nombre_error') !!}" required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="text" name="empresa" class="form-control" placeholder="{!! trans('contacto.empresa_label') !!}" data-error="{!! trans('contacto.empresa_error') !!}" required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="text" name="telefono" class="form-control" placeholder="{!! trans('contacto.telefono_label') !!}">
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="{!! trans('contacto.email_label') !!}" data-error="{!! trans('contacto.correo_error') !!}" data-required-error="{!! trans('contacto.correo_error2') !!}" required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="text" name="ciudad" class="form-control" placeholder="{!! trans('contacto.ciudad_label') !!}" data-error="{!! trans('contacto.ciudad_error') !!}" required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<textarea name="comentarios" rows="5" class="form-control" placeholder="{!! trans('contacto.comentarios_label') !!}" data-error="{!! trans('contacto.comentario_error') !!}" required></textarea>
							<small class="help-block with-errors"></small>
						</div>
                        <div class="form-group">
                    		<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LezXjArAAAAALY_fO3Kc5EV6oN0zqx8GigB66Tu"></div>
                		</div>
						<div class="form-group">
							<button id="btnEnviar" class="btn btn-block btn-enviar py-3" type="submit" disabled>
								{!! trans('contacto.enviar_btn') !!}
							</button>
						</div>
					</form>
				</div>
				<div class="col-12 col-md-6">
					<div class="contacto-ubicaciones">
						<div class="ubicacion">
							<h5><spapn class="azul-marino f600 editable"  data-group="contacto" data-key="planta_proceso">{!! trans('contacto.planta_proceso') !!}</spapn> <a href="https://www.google.com/maps/place/Mr.+Lucky/@20.6589272,-101.2966484,17z/data=!3m1!4b1!4m14!1m7!3m6!1s0x842c811f52024351:0xab3f024f06cfb5d3!2sMr.+Lucky!8m2!3d20.6589272!4d-101.2940735!16s%2Fg%2F11h8kv2zmt!3m5!1s0x842c811f52024351:0xab3f024f06cfb5d3!8m2!3d20.6589272!4d-101.2940735!16s%2Fg%2F11h8kv2zmt?entry=ttu" class="btn-mapa" target="_blank">Ver mapa</a></h5>
							<div class="mt-3 d-flex">
								<i class="fa fa-map-marker azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.direccion') !!}</span>
								<p class="ml-3 gris">
									Carretera Panamericana km. 5 <br>
									Colonia Rancho Grande  C.P. 36544 <br>
									Irapuato, Guanajuato; México <br>
									Apartado Postal 2
								</p>
							</div>
							<div class="d-flex">
								<i class="fa fa-phone azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.telefono_label') !!}</span>
								<p class="ml-3 gris">
									(462) 626-2663
								</p>
							</div>
							<div class="d-flex">
								<i class="fa fa-envelope azul-cielo mr-2"></i> <span class="azul-cielo">E-mail:</span>
								<p class="ml-3 gris">
									info@mrlucky.com.mx
								</p>
							</div>
						</div>
						<div class="ubicacion mt-5">
							<h5><spapn class="azul-marino f600 editable"  data-group="contacto" data-key="oficinas_generales">{!! trans('contacto.oficinas_generales') !!}</spapn></h5>
							<div class="mt-3 d-flex">
								<i class="fa fa-map-marker azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.direccion') !!}</span>
								<p class="ml-3 gris">
									Carretera Panamericana Km. 291-1 <br>
									Colonia La Fortaleza  C.P. 38495 <br>
									Cortazar, Guanajuato; México
								</p>
							</div>
							<div class="d-flex">
								<i class="fa fa-phone azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.telefono_label') !!}</span>
								<p class="ml-3 gris">
									 (411) 155-0949
								</p>
							</div>
							<div class="d-flex">
								<i class="fa fa-envelope azul-cielo mr-2"></i> <span class="azul-cielo">E-mail:</span>
								<p class="ml-3 gris">
									info@mrlucky.com.mx
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
                                
    <section class="py-5">
    	<div class="container">
              <h3 class="text-center azul-marino pacifico mb-4 editable" data-group="contacto" data-key="descargas">{!! trans('contacto.descargas') !!}</h3> 
              <div>
              	<a href="/docs/catalogo-mrlucky.pdf" class="d-flex align-items-center" target="_blank">
                	<img src="/site/img/icon-descarga.png" class="img-fluid mr-2" width="30" />
                    <span class="d-inline-block azul-marino m-0 p-0 h5 f600 editable" data-group="contacto" data-key="catalogo">{!! trans('contacto.catalogo') !!}</span> 
                <a>
              </div>
              <hr>
               @if(App::currentLocale() == 'es')
                 <div>
              	  <a href="/docs/Sustentabilidad_2024.pdf" class="d-flex align-items-center" target="_blank">
                	 <img src="/site/img/icon-descarga.png" class="img-fluid mr-2" width="30" />
                     <span class="d-inline-block azul-marino m-0 p-0 h5 f600 editable" data-group="contacto" data-key="boletin-10">{!! trans('contacto.boletin-10') !!}</span> 
                  <a>
                 </div> 
              @else
                 <div>
                   <a href="/docs/Sustainability.pdf" class="d-flex align-items-center" target="_blank">
                 	 <img src="/site/img/icon-descarga.png" class="img-fluid mr-2" width="30" />
                     <span class="d-inline-block azul-marino m-0 p-0 h5 f600 editable" data-group="contacto" data-key="boletin-10">{!! trans('contacto.boletin-10') !!}</span> 
                   <a>
                 </div> 
              @endif
              <hr>
              <div>
                <a href="/docs/Boletin-12-Grupo-U.pdf" class="d-flex align-items-center" target="_blank">
                	<img src="/site/img/icon-descarga.png" class="img-fluid mr-2" width="30" />
                    <span class="d-inline-block azul-marino m-0 p-0 h5 f600 editable" data-group="contacto" data-key="boletin-11">{!! trans('contacto.boletin-11') !!}</span> 
                <a>
              </div> 
              <hr>
              <div>
                <a href="/docs/Boletin-13-Grupo-U.pdf" class="d-flex align-items-center" target="_blank">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-2" width="30" />
                    <span class="d-inline-block azul-marino m-0 p-0 h5 f600 editable" data-group="contacto" data-key="boletin-12">{!! trans('contacto.boletin-12') !!}</span> 
                <a>
              </div> 
              <hr>
              <div>
                <a href="/docs/RECETARIO CALABAZAS MR. LUCKY.pdf" class="d-flex align-items-center" target="_blank">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-2" width="30" />
                    <span class="d-inline-block azul-marino m-0 p-0 h5 f600 editable" data-group="contacto" data-key="boletin-12">{!! trans('contacto.Recetario-Haloween') !!}</span> 
                <a>
              </div> 
        </div>
    </section>	

	@if($preguntas->count())
		<section class="section-faq padding bg-gris-claro">
			<div class="container">
				<h3 class="text-center lila pacifico mb-5 editable" data-group="contacto" data-key="preguntas_frecuentesp">{!! trans('contacto.preguntas_frecuentes') !!}</h3>
				<div id="accordion" class="preguntas-frecuentes">

				    @foreach($preguntas as $pregunta)
					    <div class="card">
					        <div class="card-header" id="heading{{ $loop->iteration }}">
					            <h5 class="mb-0">
					                <button class="btn btn-link gris f600" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
					                    {{ $pregunta->pregunta ?? '' }}
					                </button>
					            </h5>
					        </div>
					        <div id="collapse{{ $loop->iteration }}" class="collapse {{ ($loop->first) ? 'show' : '' }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
					            <div class="card-body">
					                {!! $pregunta->respuesta !!}
					            </div>
					        </div>
					    </div>
					@endforeach

				</div>
			</div>
		</section>
	@endif

	@if($blogs->count())
		<section class="section-noticias-recientes py-5">
			<div class="container">
				<h3 class="azul-cielo text-center pacifico mb-4 editable" data-group="contacto" data-key="articulos_recientes">{!! trans('contacto.articulos_recientes') !!}</h3>

				<div class="row">

					@foreach($blogs as $blog)
						<div class="col-12 col-sm-6 col-md-3">
							<div class="card shadow h-100 p-2">
								@if($blog->imagen)
									<img src="/uploads/{{ $blog->imagen }}" class="img-fluid" loading="lazy" alt="">
								@endif
								{{-- <span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0 small">{{ $blog->titulo ?? '' }}</span> --}}
								@if($blog->fecha)
									<span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0 small">{{ date('d/m/Y', strtotime($blog->fecha) ) }}</span>
								@endif

								<p class="py-2 mb-2">
									{{-- {!! Str::limit($blog->contenido, 120) !!} --}}
									{{ $blog->titulo  ?? '' }}
								</p>
								<a href="{{ route( App::currentLocale() . '.post', ['slug' => $blog->slug] ) }}" class="btn btn-sm btn-link text-uppercase f600 text-left">
									{!! trans ('web.leer_mas') !!}
								</a>
							</div>
						</div>
					@endforeach

				</div>
				<div class="text-center mt-4">
					<a href="{{ route( App::currentLocale() . '.blog') }}" class="btn btn-sm btn-link f600 text-left azul-cielo">
						{!! trans ('web.ver_mas') !!}
					</a>
				</div>
			</div>
		</section>
	@endif

	@if($vacantes->count())
		<section class="bg-gris-claro padding">
			<div class="container">

				<h2 class="text-center azul-claro pacifico mb-4">{{ trans('web.nuestras_vacantes') }}</h2>
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
				<div class="text-center mb-3">
					<a href="{{ route( App::currentLocale() . '.vacantes') }}" class="btn btn-sm btn-link f600 text-left azul-cielo">
						{!! trans ('web.ver_mas') !!}
					</a>
				</div>
			</div>
		@endif
@stop

@section('customCSS')
	@parent
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
          
	<script>
        function recaptchaCallback() {
            $('#btnEnviar').removeAttr('disabled');
        }

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