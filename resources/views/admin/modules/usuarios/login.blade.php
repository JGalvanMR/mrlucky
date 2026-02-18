@php
    $config = new Larapack\ConfigWriter\Repository('rentas');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/admin/assets/images/favicon.png">
    <title>Iniciar sesión</title>
    <!-- Bootstrap Core CSS -->
    <link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- page css -->
    <link href="/admin/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/admin/css/style.css" rel="stylesheet">

    <!-- You can change the theme colors from here -->
    <link href="/admin/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        .btn-info{
            background-color: #015393 !important;
            border-color: #015393 !important;
        }
        .form-material .form-control, .form-material .form-control.focus, .form-material .form-control:focus{
            background-image: linear-gradient(#015393, #015393), linear-gradient(#e9edf2, #e9edf2);
        }
    </style>
    <x-scripts />
    @yield('customCSS')
</head>

<body class="card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Cargando...</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(/uploads/{{ $config->get('portada')  }});">
            <div class="login-box card shadow">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginForm" action="{{ route('login') }}" data-disable="false">
                        <div class="text-center mb-2">
                            @if(  $config->get('logo') )
                                <img src="/uploads/{{ $config->get('logo') }}" alt="homepage" class="img-fluid d-inline-block mb-3" />
                            @endif
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" type="email" placeholder="Email" data-required-error="*Su email es requerido." data-error="*Ingrese una cuenta de correo válida." required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" placeholder="Contraseña" data-error="*Su contraseña es requerida." required>
                                 <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                        <input type="hidden" value="" name="captchaResponse" id="captchaResponse">
                        {{-- <div class="g-recaptcha" data-sitekey="6LeNNakUAAAAAPxR7NsuOUC2mgSP9ncKtCO8ulbk"></div> --}}
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded"  type="submit">Ingresar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-validator />

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="/admin/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    {{-- <script src="https://www.google.com/recaptcha/api.js?render=6LeNNakUAAAAAPxR7NsuOUC2mgSP9ncKtCO8ulbk"></script> --}}

    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('customJS')
    <x-ajax-form id="loginForm" titulo="Iniciar sesión" reload="1" />

</body>

</html>

