 @php
    $config = new Larapack\ConfigWriter\Repository('rentas');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ env('APP_NAME') }} | </title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/site/css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/site/js/whatsapp/floating-wpp.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.2.9/css/jquery.mb.YTPlayer.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
	@if(auth()->check())
		<link rel="stylesheet" href="/admin/assets/plugins/summernote/dist/summernote.css" />
		<style>
			.editable:hover{ border: dashed 1px #ED0013; }
		</style>
	@endif
	<style>
		.dropdown:hover .dropdown-menu {
			   display: block;
			   margin-top: 0; /* remove the gap so it doesn't close */
			}
		.dropdown a{ font-size:14px !important; text-transform: uppercase; }
	</style>
	@yield('customCSS')
</head>
<body>
    
	@include('site.partials.header')

	@yield('page')

	@include('site.partials.footer')

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" defer></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" defer></script>
	<!-- <script src="https://mmkjony.github.io/enllax.js/jquery.enllax.min.js" defer></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js" defer></script>
	{{-- <script>
	    var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

	    if ( width > 600) {
	        document.write('<script src="js/scroll-entrance.js"><\/script>');
	    }
	</script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-smooth-scroll/2.2.0/jquery.smooth-scroll.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" defer></script>
	<script src="/site/js/whatsapp/floating-wpp.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.2.9/jquery.mb.YTPlayer.min.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	@if(auth()->check())
		<script src="https://unpkg.com/sweetalert2@7.22.0/dist/sweetalert2.all.js" defer></script>
		<script src="/admin/assets/plugins/summernote/dist/summernote.min.js" defer></script>
		<script src="/admin/assets/plugins/summernote/dist/lang/summernote-es-ES.min.js" defer></script>
	@endif
	<script>

	    /*----------  Loader  ----------*/
	    $('.fakeLoader').fakeLoader({
	        timeToHide: 500,
	        spinner: 'spinner1',
	        bgColor: '#003CA6',
	        zIndex: '5000'
	    });

	    $(function(){

	        /*----------  Parallax dulces  ----------*/
	        // $(window).enllax();

	        /*----------  Video Intro  ----------*/
	        //$("#video").YTPlayer();

	        /*----------  WhatsApp  ----------*/
	        // if($('#whatsapp').length){
	        //     $('#whatsapp').floatingWhatsApp({
	        //         phone: '521',
	        //         popupMessage: 'Hola, en Mr Lucky estamos para servirte',
	        //         message: "Hola, deseo asesoría.",
	        //         showPopup: true,
	        //         showOnIE: false,
	        //         headerTitle: 'Envíanos un WhatsApp',
	        //         position: 'right',
	        //         buttonImage: '<img src="js/whatsapp/whatsapp.svg" />',
	        //         size: '50px',
	        //         //autoOpenTimeout: 100
	        //     });
	        // }

	        /*----------  Galería  ----------*/
	        $('.galeria').each(function() {
	            $(this).magnificPopup({
	                delegate: 'a',
	                type: 'image',
	                gallery: {
	                  enabled: true
	                }
	            });
	        });

	        /*----------  Testimoniales  ----------*/
	        $('.lineaTiempo').slick({
	            dots: false,
	            infinite: true,
	            speed: 300,
	            slidesToShow: 4,
	            slidesToScroll: 1,
	            autoplay: false,
	            arrows: true,
	            responsive: [
	                {
	                    breakpoint: 962,
	                    settings: {
	                        slidesToShow: 3,
	                        slidesToScroll: 2
	                    }
	                },
	                {
	                    breakpoint: 600,
	                    settings: {
	                        slidesToShow: 2,
	                        slidesToScroll: 1,
	                        dots: false
	                    }
	                }
	          ]
	        });

	        $('.prev-btn').on('click', function(){
	            $(".lineaTiempo").slick("slickPrev");
	        });

	        $('.next-btn').on('click', function(){
	            $(".lineaTiempo").slick("slickNext");
	        });


		    /*----------  Traducciones  ----------*/
	       	@if(auth()->check())
	       		function cancelar(){
	       			let current = $('.currentEditor');
					current.removeClass('currentEditor');
					current.summernote('destroy');
					$('.cancelarBtn').remove();
					$('.saveBtn').remove();

					return false;
	       		}
		      	function guardar(){
					let current = $('.currentEditor');
					let text = "";
					let key = current.data('key');
					let group = current.data('group');
					let lang = "{{ App::currentLocale() }}";
					current.removeClass('currentEditor');
					text = current.summernote('code').trim();
					current.summernote('destroy');
					$('.cancelarBtn').remove();
					$('.saveBtn').remove();

					$.ajax({
						url: "{{ route('traducciones.editar_detalle') }}",
						cache: false,
						type: 'post',
						data: {
							key: key,
							group: group,
							lang: lang,
							val: text,
							_token: "{{ csrf_token() }}"
						},
						dataType: 'json',
						succcess: function(res){
							console.log(res);
							swal({
                                text: res.msg,
                                type: res.class,
                                showConfirmButton: true,
                            });
						}
					});

					return false;
				}

				$('.editable').on('click', function(){
					if($('.currentEditor').length){
						guardar();
					}

					let current = $(this);
					let cerrarBtn = `<div class="my-2 text-right">
											<a href="#." class="btn btn-sm btn-danger cancelarBtn"><i class="fa fa-close text-white"></i></a>
											<a href="#." class="btn btn-sm btn-success saveBtn"><i class="fa fa-save text-white"></i></a>
										</div>`;

					current.addClass('currentEditor');
					current.after(cerrarBtn);

					let editor = $(this).summernote({
						focus: true,
						toolbar: [
					   	['view', ['codeview']]
					  	],
					});

				});

				$('body').on('click', '.cancelarBtn', cancelar);
				$('body').on('click', '.saveBtn', guardar);
			@endif

			setTimeout(function(){
	            var hash = window.location.hash.substr(1);
	            if(hash){

	                $('html, body').animate({
	                    scrollTop: $("#"+hash).offset().top - 105
	                }, 100);
	            }
	        }, 1000);

	    });
	</script>
	@yield('customJS')


</body>
</html>