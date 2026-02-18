@extends('site.layouts.master')
@php
	$active = 'blog';
@endphp

@section('page')
	<img src="/site/img/banner-blog.jpg" loading="lazy" class="img-fluid w-100">

	@if($destacado)
		<section class="post-destacado padding">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6 order-md-2 d-flex align-items-center">
						<img src="/uploads/{{ $destacado->imagen }}" alt="" class="img-fluid w-100" loading="lazy">
					</div>
					<div class="col-12 col-md-6 order-md-1 d-flex align-items-center">
						<div>
							<h2 class="h4 mb-4 verde">{{ $destacado->titulo }}</h2>
							{!! Str::limit($destacado->contenido, 200) !!}
							<div></div>
							<a href="{{ route( App::currentLocale() . '.post', ['slug' => $destacado->slug] ) }}" class="btn btn-sm bg-azul-marino text-white f600 small">
								{{ trans('web.leer_mas') }}
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	@endif

	@if($blogs->count())
		<section class="bg-gris-claro padding section-blog">
			<div class="container">
				<h2 class="text-center azul-marino pacifico mb-4">{{ trans('web.mas_reciente') }}</h2>
				<div class="row posts">
					@foreach($blogs as $blog)
						<div class="col-12 col-md-4 mb-5">
							<div class="post shadow bg-white">
								<img src="/uploads/{{ $blog->imagen }}" class="img-fluid" alt="{{ $blog->titulo }}" alt="{{ $blog->titulo }}" loading="lazy">
								<div class="px-3 py-2">
									<h3 class="h5 small gris">{{ $blog->titulo }}</h3>
									<a href="{{ route( App::currentLocale() . '.post', ['slug' => $blog->slug] ) }}" class="small azul-marino f600">{{ trans('web.leer_mas') }}</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="w-100 d-flex justify-content-center align-items-center">
					{{ $blogs->links() }}
				</div>
			</div>
		@endif
	</section>
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