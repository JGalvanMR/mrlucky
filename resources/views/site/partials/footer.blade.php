<!-- Footer -->
	<div class="prefooter py-3 {{ ($active == 'home' || $active == 'blog' ) ? 'bg-white' : '' }}">
		<div class="container">
			<div class="text-center azul-marino">
				<div class="logos mb-3">
					<img src="/site/img/logos.png" class="img-fluid" loading="lazy" alt="">
				</div>
				<span class="f600 azul-marino">Carretera Panamericana km 5 </span><br>
				Colonia Rancho Grande   CP 36544, Irapuato, Guanajuato, MX
			</div>
			<div class="text-center my-4">
				<p class="text-center rojo text-uppercase mb-2">
					{!! trans('web.llamanos') !!}
				</p>
				<a href="tel:4626262663" class="button bg-rojo text-white f600">
					(462) 626-2663
				</a>
			</div>
			<div class="text-center redes">
				<a href="https://www.instagram.com/mrluckyfresco/" target="_blank"><i class="fa fa-instagram"></i></a>
				<a href="https://www.facebook.com/profile.php?id=100064424094711" target="_blank"><i class="fa fa-facebook"></i></a>
				{{-- <a href="" target="_blank"><i class="fa fa-twitter"></i></a> --}}
				<a href="https://www.linkedin.com/company/comercializadoragabsadecv/" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="https://www.youtube.com/@MrLucky-jc7hq" target="_blank"><i class="fa fa-youtube"></i></a>
				{{-- <a href="#." target="_blank"><i class="fa fa-pinterest"></i></a> --}}
				<!-- <a href="#."><i class="fa fa-tiktok"></i></a> -->
			</div>
			<div class="links text-center">
				<ul class="list-unstyled p-0 m-0">
					<li><a href="#.">{!! trans('web.legal') !!}</a></li>
					<li><a href="/site/certificaciones/POLITICA_DE_PRIVACIDAD_MR_LUCKY.pdf" target="_blank">{!! trans('web.privacidad') !!}</a></li>
					<li><a href="#.">{!! trans('web.cookies') !!}</a></li>
					<li><a href="{{ route( App::currentLocale() . '.vacantes') }}">{!! trans('web.vacantes') !!}</a></li>
				</ul>
			</div>
		</div>
	</div>
	<footer class="bg-azul-marino py-3">
		<div class="container">
			<p class="text-white text-center m-0 opacity-70 small text-uppercase">
				<span class="text-white editable" data-key="copy" data-group="web">{!! trans('web.copy') !!}</span> <?php echo date('Y'); ?>
			</p>
		</div>
	</footer>
    <div class="text-center small py-2">
    	Desarrollado por <a href="https://brandhouse.com.mx" class="" target="_blank">Brandhouse Marketing</a>
	</div>
	<div id="whatsapp"></div>