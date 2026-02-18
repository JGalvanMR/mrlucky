<!-- Scripts -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" defer></script>
<!-- <script src="https://mmkjony.github.io/enllax.js/jquery.enllax.min.js" defer></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js" defer></script>
<script>
    var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if ( width > 600) {
        document.write('<script src="js/scroll-entrance.js"><\/script>');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-smooth-scroll/2.2.0/jquery.smooth-scroll.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" defer></script>
<script src="js/whatsapp/floating-wpp.js"></script>
<script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.2.9/jquery.mb.YTPlayer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
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

    });
</script>