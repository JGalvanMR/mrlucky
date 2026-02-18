<div id="inicio" class="fakeLoader"></div>
<header class="shadow sticky-top">
	<div class="text-right redes d-none d-lg-block">
		<a href="https://www.instagram.com/mrluckyfresco/" target="_blank"><i class="fa fa-instagram"></i></a>
		<a href="https://www.facebook.com/profile.php?id=100064424094711" target="_blank"><i class="fa fa-facebook"></i></a>
		{{-- <a href="" target="_blank"><i class="fa fa-twitter"></i></a> --}}
		<a href="https://www.linkedin.com/company/comercializadoragabsadecv/" target="_blank"><i class="fa fa-linkedin"></i></a>
		<a href="https://www.youtube.com/@MrLucky-jc7hq" target="_blank"><i class="fa fa-youtube"></i></a>
		{{-- <a href="#." target="_blank"><i class="fa fa-pinterest"></i></a> --}}
		<!-- <a href="#."><i class="fa fa-tiktok"></i></a> -->
	</div>
	<div class="container-fluid d-lg-flex justify-content-lg-center">
		<a href="{{ route( App::currentLocale() . '.inicio') }}" class="logo-mobile d-lg-none">
			<img src="/site/img/logo.png" class="img-fluid" alt="">
		</a>
		<nav class="d-none d-lg-flex">
			<ul class="d-flex align-items-center text-center">
				{{-- <li><a href="{{ route( App::currentLocale() . '.nosotros') }}">{{ trans('web.menu_nosotros_text') }}</a></li> --}}
				<div class="dropdown show">
					<a href="#." class="p-2 dropdown-toggle text-uppercase text-decoration-none" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
						{{ trans('web.menu_nosotros_text') }}
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<li>
							<a class="dropdown-item" href="{{ route( App::currentLocale() . '.nosotros') }}">Mr. Lucky</a>
							<a class="dropdown-item" href="{{ route( App::currentLocale() . '.grupo_u') }}">{!! trans('web.menu_grupo_text') !!}</a>
						</li>
					</div>
				</div>
				<li><a href="{{ route( App::currentLocale() . '.compromiso') }}">{{ trans('web.menu_compromiso_text') }}</a></li>
				<li><a href="{{ route( App::currentLocale() . '.productos') }}">{{ trans('web.menu_productos_text') }}</a></li>
				<li><a href="{{ route( App::currentLocale() . '.recetas') }}">{{ trans('web.menu_recetas_text') }}</a></li>
				<li>
					<a href="{{ route( App::currentLocale().'.inicio' ) }}" class="logo">
						<img src="/site/img/logo.png" class="img-fluid" alt="">
					</a>
				</li>
				<li><a href="{{ route( App::currentLocale() . '.blog') }}">Blog</a></li>
				<li><a href="{{ route( App::currentLocale() . '.contacto') }}">{{ trans('web.menu_contacto_text') }}</a></li>
				{{-- <div class="dropdown show">
				  	<a href="{{ route(App::currentLocale() . '.contacto') }}" class="p-2 dropdown-toggle text-uppercase text-decoration-none" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
				{{ trans('web.menu_contacto_text') }}
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<li>
						<a class="dropdown-item" href="{{ route( App::currentLocale() . '.vacantes') }}">{!! trans('web.nuestras_vacantes') !!}</a>
					</li>
				</div>
	</div> --}}
	{{-- <li><a href="{{ route( App::currentLocale() . '.grupo_u') }}">{{ trans('web.menu_grupo_text') }}</a></li> --}}
	{{-- <li><a href="#.">{{ trans('web.menu_clientes_text') }}</a></li> --}}
	<div class="dropdown show">
		<a class="p-2 dropdown-toggle text-uppercase tex-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			{{ trans('web.menu_clientes_text') }}
		</a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			@if(App::currentLocale() == 'en')
			<a class="dropdown-item" href="http://gab.mrlucky.com.mx/ventasnew/" target="_blank">{!! trans('web.pedidos') !!}</a>
			<a class="dropdown-item" href="http://gab.mrlucky.com.mx/english/trazabilidad/index.html" target="_blank">{!! trans('web.trazabilidad') !!}</a>
			<a class="dropdown-item" href="http://gab.mrlucky.com.mx/english/productos.php" target="_blank">{!! trans('web.cosecha_dia') !!}</a>
			<a class="dropdown-item" href="{{ route('en.certificados_ranchos') }}">Ranch certificates</a>
			@else
			<a class="dropdown-item" href="http://gab.mrlucky.com.mx/ventasnew/" target="_blank">{!! trans('web.pedidos') !!}</a>
			<a class="dropdown-item" href="http://gab.mrlucky.com.mx/trazabilidad/index.html" target="_blank">{!! trans('web.trazabilidad') !!}</a>
			<a class="dropdown-item" href="http://gab.mrlucky.com.mx/productos.php" target="_blank">{!! trans('web.cosecha_dia') !!}</a>
			<a class="dropdown-item" href="{{ route('es.certificados_ranchos') }}">Certificados de ranchos</a>
			@endif
		</div>
	</div>
	<li><a href="{{ route( App::currentLocale() . '.vacantes') }}">{{ trans('web.nuestras_vacantes') }}</a></li>
	<div class="dropdown show">
		<a class="p-2 bg-azul-marino dropdown-toggle text-white text-uppercase" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-globe text-white"></i> {{ trans('web.lang_'.App::currentLocale()) }}
		</a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="{{ current_route('es') }}">{{ trans('web.lang_es') }}</a>
			<a class="dropdown-item" href="{{ current_route('en') }}">{{ trans('web.lang_en') }}</a>
		</div>
	</div>
	</ul>
	</nav>

	<div class="hamburger-menu d-lg-none">
        
        <div class="dropdown" style="position:absolute;top: -45px;right: 55px;">
			<a class="p-2 bg-azul-marino dropdown-toggle text-white text-uppercase" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-globe text-white"></i> {{ trans('web.lang_'.App::currentLocale()) }}
			</a>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="{{ current_route('es') }}">{{ trans('web.lang_es') }}</a>
				<a class="dropdown-item" href="{{ current_route('en') }}">{{ trans('web.lang_en') }}</a>
			</div>
		</div>
        
		<input id="menu__toggle" type="checkbox" />
		<label class="menu__btn" for="menu__toggle">
			<span></span>
		</label>

		<ul class="menu__box">
			<li><a href="{{ route( App::currentLocale() . '.inicio') }}" class="menu__item">{{ trans('web.menu_home_text') }}</a></li>
			<li><a href="{{ route( App::currentLocale() . '.nosotros') }}" class="menu__item">{{ trans('web.menu_nosotros_text') }}</a></li>
			<li><a href="{{ route( App::currentLocale() . '.compromiso') }}" class="menu__item">{{ trans('web.menu_compromiso_text') }}</a></li>
			<li><a href="{{ route( App::currentLocale() . '.productos') }}" class="menu__item">{{ trans('web.menu_productos_text') }}</a></li>
			<li><a href="{{ route( App::currentLocale() . '.recetas') }}" class="menu__item">{{ trans('web.menu_recetas_text') }}</a></li>
			<li><a href="{{ route( App::currentLocale() . '.contacto') }}" class="menu__item">{{ trans('web.menu_contacto_text') }}</a></li>
			<li><a href="{{ route( App::currentLocale() . '.grupo_u') }}" class="menu__item">{{ trans('web.menu_grupo_text') }}</a></li>
			@if(App::currentLocale() == 'en')
			<li><a class="menu__item" href="http://mrlucky.com.mx/ventasnew/" target="_blank">{!! trans('web.pedidos') !!}</a></li>
			<li><a class="menu__item" href="http://gab.mrlucky.com.mx/english/trazabilidad/index.html" target="_blank">{!! trans('web.trazabilidad') !!}</a></li>
			<li><a class="menu__item" href="http://gab.mrlucky.com.mx/english/productos.php" target="_blank">{!! trans('web.cosecha_dia') !!}</a></li>
			<li><a class="menu__item" href="{{ route('en.certificados_ranchos') }}">Ranch certificates</a></li>
			@else
			<li><a class="menu__item" href="http://mrlucky.com.mx/ventasnew/" target="_blank">{!! trans('web.pedidos') !!}</a></li>
			<li><a class="menu__item" href="http://gab.mrlucky.com.mx/trazabilidad/index.html" target="_blank">{!! trans('web.trazabilidad') !!}</a></li>
			<li><a class="menu__item" href="http://gab.mrlucky.com.mx/productos.php" target="_blank">{!! trans('web.cosecha_dia') !!}</a></li>
			<li><a class="menu__item" href="{{ route('es.certificados_ranchos') }}">Certificados de ranchos</a></li>
			@endif
		</ul>

	</div>
	</div>
</header>