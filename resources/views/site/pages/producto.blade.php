@extends('site.layouts.master')
@php
    $active = 'productos';
@endphp

@section('page')
    <section class="section-producto">
        @if($producto->imagen)
            <div class="img-produto text-center">
				<img id="imgPrincipal" src="/uploads/{{ $producto->imagen }}" class="img-fluid img-producto" loading="lazy" alt="">
			</div>
		@endif
		<div class="container-fluid">
			<div class="row no-gutters">
				<div class="col-12 col-lg-6 px-3 py-5">
					<div class="row">
						<div class="col-lg-8 d-flex align-items-center">
							<div>
								<div class="d-block d-md-none">
									<div class="galeria row d-flex align-items-end">
										@if($producto->imagenes->count())
											@if($producto->imagen)
												<div class="item col-4 p-3">
													<img src="/uploads/{{ $producto->imagen }}" class="img-fluid" loading="lazy">
												</div>
											@endif
											@foreach($producto->imagenes as $imagen)
												<div class="item col-4 p-3">
													<img src="/uploads/{{ $imagen->ruta }}" class="img-fluid" loading="lazy">
												</div>
											@endforeach
										@endif
									</div>
								</div>
								<h2 class="h1 gris f800 text-center">{{ $producto->titulo ?? '' }}</h2>
								<div class="row my-3">
									@if($producto->descripcion)
										<div class="col-6 col-md-4 text-center click-info" data-btn="descripcion">
											<img src="/site/img/icons/descripcion.png" class="img-fluid" loading="lazy" alt="">
											<p class="gris small text-uppercase f600 my-3 editable" data-group="producto" data-key="descripcion">
												{{ trans('producto.descripcion') }}
											</p>
										</div>
									@endif
									@if($producto->nutricion)
										<div class="col-6 col-md-4 text-center click-info" data-btn="nutricion">
											<img src="/site/img/icons/nutricion.png" class="img-fluid" loading="lazy" alt="">
											<p class="gris small text-uppercase f600 my-3 editable" data-group="producto" data-key="nutricion">
												{{ trans('producto.nutricion') }}
											</p>
										</div>
									@endif
									@if($producto->usos)
										<div class="col-6 col-md-4 text-center click-info" data-btn="usos">
											<img src="/site/img/icons/usos.png" class="img-fluid" loading="lazy" alt="">
											<p class="gris small text-uppercase f600 my-3 editable" data-group="producto" data-key="usos">
												{{ trans('producto.usos') }}
											</p>
										</div>
									@endif
									@if($producto->conservacion)
										<div class="col-6 col-md-4 text-center click-info" data-btn="conservacion">
											<img src="/site/img/icons/conservacion.png" class="img-fluid" loading="lazy" alt="">
											<p class="gris small text-uppercase f600 my-3 editable" data-group="producto" data-key="conservacion">
												{{ trans('producto.conservacion') }}
											</p>
										</div>
									@endif
									@if($producto->ficha)
										<div class="col-6 col-md-4 text-center">
											<a href="/uploads/{{ $producto->ficha }}" class="magnific text-decoration-none">
												<img src="/site/img/icons/ficha-tecnica.png" class="img-fluid" loading="lazy" alt="">
												<p class="gris small text-uppercase f600 my-3 editable" data-group="producto" data-key="ficha">
													{!! trans('producto.ficha') !!}
												</p>
											</a>
										</div>
									@endif
								</div>

								<div class="d-none d-md-block">
									<div class="galeria row d-flex align-items-end">
										@if($producto->imagenes->count())
											@if($producto->imagen)
												<div class="item col-4 p-3">
													<img src="/uploads/{{ $producto->imagen }}" class="img-fluid" loading="lazy">
												</div>
											@endif
											@foreach($producto->imagenes as $imagen)
												<div class="item col-4 p-3">
													<img src="/uploads/{{ $imagen->ruta }}" class="img-fluid" loading="lazy">
												</div>
											@endforeach
										@endif
									</div>
								</div>

								<a href="javascript:history.back();" class="button bg-verde text-white mt-5 d-inline-block small">
									<i class="fa fa-angle-left text-white"></i> {!! trans('producto.regresar') !!}
								</a>

							</div>
						</div>
						<div class="col-lg-4"></div>
					</div>
				</div>
				<div class="col-12 col-lg-6 bg-gris-claro">
					<div class="row info">
						<div class="col-lg-4"></div>

						<div class="col-lg-8 text-center py-5">
							@if($producto->descripcion)
								<div class="descripcion d-none panel-info">
									<h3 class="verde text-center pacifico mb-3">{!! trans('producto.descripcion') !!}</h3>
									<div class="pr-3">
										{!! $producto->descripcion ?? '' !!}
									</div>
								</div>
							@endif
							@if($producto->nutricion)
								<div class="nutricion d-none panel-info">
									<h3 class="verde text-center pacifico mb-3">{!! trans('producto.nutricion') !!}</h3>
									<div class="pr-3">
										{!! $producto->nutricion ?? '' !!}
									</div>
								</div>
							@endif
							@if($producto->usos)
								<div class="usos d-none panel-info">
									<h3 class="verde text-center pacifico mb-3">{!! trans('producto.usos') !!}</h3>
									<div class="pr-3">
										{!! $producto->usos ?? '' !!}
									</div>
								</div>
							@endif
							@if($producto->conservacion)
								<div class="conservacion d-none panel-info">
									<h3 class="verde text-center pacifico mb-3">{!! trans('producto.conservacion') !!}</h3>
									<div class="pr-3">
										{!! $producto->conservacion ?? '' !!}
									</div>
								</div>
							@endif

							@if($producto->tabla_nutrimental)
								<a href="/uploads/{{ $producto->tabla_nutrimental }}" class="button bg-verde text-white f600 text-uppercase mt-5 d-inline-block magnific">
									{!! trans('producto.nutrimental') !!}
								</a>
							@endif
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- @if($producto->imagenes->count())
		<section class="py-5 bg-azul-marino">
			<div class="container">
				<div style="width:400px; margin: 0 auto;">
					<div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
						@foreach($producto->imagenes as $imagen)
							<a href="/uploads/{{ $imagen->ruta }}">
								<img src="/uploads/{{ $imagen->ruta }}" class="img-fluid" loading="lazy" alt="">
							</a>
						@endforeach
					</div>
				</div>
			</div>
		</section>
	@endif --}}
@stop

@section('customCSS')
	@parent
	{{-- <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> --}}
	<style>
		.click-info{ cursor: pointer; }
		.galeria .item img{ transform: scale(1); transition: all .3s; }
		.galeria .item img:hover{ transform: scale(1.2); transition: all .3s; cursor: pointer;}
	</style>
@stop

@section('customJS')
	@parent
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> --}}
	<script>
		$(function(){

			$('.click-info').on('click', function(){
				$('.panel-info').addClass('d-none');
				console.log('.'+$(this).data('btn'));
				$('.'+$(this).data('btn')).removeClass('d-none');
			});

			$('.click-info').first().click();

			$('.magnific').magnificPopup({type:'iframe'});

            $('.galeria .item img').on('click', function(){
            	let img = $(this).attr('src');
            	$('#imgPrincipal').attr('src', img);
            });

		});
	</script>
@stop