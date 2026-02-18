@extends('site.layouts.master')
@php
    $active = 'productos';
@endphp

@section('page')
    {{-- <img src="/site/img/banner-blog.jpg" loading="lazy" class="img-fluid w-100"> --}}
    @if(App::currentLocale() == 'es')
    	<img src="/site/img/banner-productos.jpg" alt="" class="img-fluid w-100" loading="lazy">
	@else
		<img src="/site/img/banner-productos-en.jpg" alt="" class="img-fluid w-100" loading="lazy">
	@endif

	<section class="section-btns-categorias padding">
		<div class="container">
			<div class="text-center">
				<h2 class="rojo pacifico h1 mb-4 editable" data-group="productos" data-key="nuestros_productos">{!! trans('productos.nuestros_productos') !!}</h2>
			</div>
			@if($categorias->count())
				<div class="row d-flex justify-content-center">
					@foreach($categorias as $categoria)
						<div class="col-6 col-sm-4 col-md-3 col-lg mb-4 mb-lg-0">
							<div class="btn-categoria shadow p-4 text-center bg-white" data-categoria="{{ $categoria->id }}" data-banner="{{ $categoria->banner }}" data-nombre="{{ $categoria->nombre }}">
								<img src="/uploads/{{ $categoria->banner }}" class="img-fluid" loading="lazy" alt="">
							</div>
							<p class="text-uppercase azul-marino m-0 f600 text-center my-3">
								{{ $categoria->nombre ?? '' }}
							</p>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</section>

	<section class="section-productos padding">
		<div class="container">
			<div class="text-center">
				<img id="categoriaBanner" src="" class="img-fluid" loading="lazy" alt="">
				<div class="m300 mx-auto my-3">
					<h3 id="categoriaNombre" class="text-center text-uppercase azul-marino f600"></h3>
				</div>
			</div>
			<div id="productos" class="row mt-4 text-center d-flex justify-content-center">
				{{-- <div class="col-6 col-sm-4 col-md-3 col-lg">
					<a href="producto.php">
						<div class="producto">
							<img src="img/productos/producto-01.jpg" alt="" loading="lazy" class="img-fluid">
							<h5 class="gris text-uppercase">Ajo morado</h5>
						</div>
					</a>
				</div> --}}
			</div>
		</div>
		<div class="text-center mt-5">
            @if(App::currentLocale() == 'es')
                <a href="/site/img/calendario.jpg" class="button bg-azul-marino text-white f600 text-uppercase magnific editable" data-group="productos" data-key="calendario">
    			    {!! trans('productos.calendario') !!}
			    </a>
            @else
                <a href="/site/img/availability.jpg" class="button bg-azul-marino text-white f600 text-uppercase magnific editable" data-group="productos" data-key="calendario">
        		    {!! trans('productos.calendario') !!}
			    </a>
            @endif
			
		</div>
        
	</section>
@stop

@section('customCSS')
	@parent
@stop

@section('customJS')
	@parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.3/jquery.scrollTo.min.js"></script>
	<script>
		$(function(){
        
        	let ancla = 0;

			$('.btn-categoria').on('click', function(){
				$(this).addClass('active');
				$('.btn-categoria').not(this).removeClass('active');
				let categoria_id = $(this).data('categoria');
				let categoria = $(this).data('nombre');
				let banner = $(this).data('banner');

				$.ajax({
					url: "{{ route('api.productos', ['categoria_id' => '']) }}/"+categoria_id,
					cache: false,
					type: 'get',
					dataType: 'json',
					success: function(res){
						//console.log('res');
						let productos = '';
						$.each(res, function(pos, producto){

							productos += `
								<div class="col-6 col-sm-4 col-md-3 mb-3">
									<a href="{{ route( App::currentLocale() . '.producto', ['slug' => ''] ) }}/${producto.slug}">
										<div class="producto">
											<img src="/uploads/${producto.imagen}" alt="${producto.titulo}" loading="lazy" class="img-fluid" width="400" height="400">
											<h5 class="gris text-uppercase">${producto.titulo}</h5>
										</div>
									</a>
								</div>
							`;
						});
						$('#categoriaNombre').html(categoria);
						$('#productos').html(productos);
						$('#categoriaBanner').attr('src', banner);
                    
                    	if(ancla){
                        
                        	$('body').scrollTo('#productos', {
                            	duration: 500,
                           	 	offset: -300
                        	});
                        }
                    	
                    	ancla = 1;
                    	
					}
				});



			});

			$('.magnific').magnificPopup({
				type: 'image'
			});

			setTimeout(function(){
				$('.btn-categoria').first().trigger('click');
			},1000)

		});
	</script>
@stop