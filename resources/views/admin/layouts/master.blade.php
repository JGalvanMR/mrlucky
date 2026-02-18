@php
    $config = new Larapack\ConfigWriter\Repository('rentas');
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/uploads/{{ $config->get('favicon') }}">
    <title>{{ env('APP_NAME') }} | @yield('titulo')</title>
    <!-- Bootstrap Core CSS -->
    <link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> --}}
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
    <x-scripts />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('customCSS')
    @livewireStyles
    <style>
        .card-info{
            background-color: {{ $config->get('colorSecundario') }};
            border-color: {{ $config->get('colorSecundario') }};
        }
        .btn-primary{
            background-color: {{ $config->get('colorPrincipal') }};
            border-color: {{ $config->get('colorPrincipal') }};
        }
        .btn-primary:hover{
            background-color: {{ $config->get('colorSecundario') }};
            border-color: {{ $config->get('colorSecundario') }};
        }
        .bg-primary{ background-color: {{ $config->get('colorPrincipal') }} !important; }
        p{ font-weight: 400;}
        h5{ font-weight: 600; }
        [x-cloak] { display: none !important; }
    </style>

</head>

<body class="fix-header card-no-border fix-sidebar">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Cargando...</p>
        </div>
    </div>

    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#.">
                        <!-- Logo icon -->
                        <b>
                            {{-- <img src="/uploads/{{ $config->get('favicon') }}" alt="homepage" class="dark-logo img-fluid" /> --}}
                            <img src="/uploads/{{ $config->get('logo_header') }}" alt="homepage" class="dark-logo img-fluid" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down"></li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->name ?? '--' }} <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li><a href="{{ url('salir') }}"><i class="fa fa-power-off"></i> Salir</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @include('admin.partials.menu')

        <div class="page-wrapper">

            @yield('page')

            <footer class="footer text-right">
                {!! $config->get('copy') !!}
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> --}}
    <script src="/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="/admin/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="/admin/js/waves.js"></script>
    <script src="/admin/js/sidebarmenu.js"></script>
    <script src="/admin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="/admin/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="/admin/js/custom.min.js"></script>
    <script>
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dropdown-toggle').dropdown();
    </script>
    @yield('customJS')
    @livewireScripts

</body>
</html>