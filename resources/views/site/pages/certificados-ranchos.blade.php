@extends('site.layouts.master')

@section('page')
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            @if(App::currentLocale() == 'en')
                <h1 class="azul-marino text-uppercase">Ranch certificates</h1>
                <p class="gris mb-0">Review certifications by ranch where products are harvested.</p>
            @else
                <h1 class="azul-marino text-uppercase">Certificados por rancho</h1>
                <p class="gris mb-0">Consulta las certificaciones por cada rancho donde se cosechan nuestros productos.</p>
            @endif
        </div>

        <div class="row">
            @foreach($ranchos as $rancho)
                <div class="col-12 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="azul-marino mb-1">{{ $rancho['nombre'] }}</h4>
                            <p class="text-muted mb-3">{{ $rancho['ubicacion'] }}</p>

                            <ul class="list-unstyled mb-0">
                                @foreach($rancho['certificados'] as $certificado)
                                    <li class="mb-2">
                                        <a href="{{ $certificado['archivo'] }}" target="_blank" rel="noopener" class="text-decoration-none">
                                            <i class="fa fa-file-pdf-o text-danger"></i>
                                            {{ $certificado['nombre'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
