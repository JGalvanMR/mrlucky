@extends('site.layouts.master')
@php
	$active = 'blog';
@endphp

@section('page')
	{{-- <img src="/site/img/banner-blog.jpg" loading="lazy" class="img-fluid w-100"> --}}

	<section class="bg-gris-claro py-4">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="article shadow">
						@if($post->imagen)
							<img src="/uploads/{{ $post->imagen }}" alt="" class="img-fluid w-100" loading="lazy">
						@endif
						<div class="bg-white p-3">
							<h2 class="azul-marino f600 mb-4">{{ $post->titulo ?? '' }}</h2>
							{!! $post->contenido ?? '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@stop

@section('customCSS')
	@parent
	<style>
		b,strong{ font-weight: 600; }
		p{ margin-bottom: 0; }
	</style>
@stop

@section('customJS')
	@parent
	<script>
		$(function(){

		});
	</script>
@stop