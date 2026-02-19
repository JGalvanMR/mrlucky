{{--
    ═══════════════════════════════════════════════════════════════════════
    ARCHIVO: resources/views/site/partials/certificados-mosaico.blade.php
    ═══════════════════════════════════════════════════════════════════════

    Partial renderizado en el servidor e inyectado vía AJAX en el modal.

    Recibe:
      $ranchos            Collection<Rancho>  — con $rancho->cert adjunto
      $tipoCertificacion  TipoCertificacion   — tipo actual (PrimusGFS, etc.)

    Los estilos CSS están en la sección @section('customCSS') de compromiso.blade.php.
--}}

@if($ranchos->isEmpty())

    {{-- Estado vacío ─────────────────────────────────────────────────────── --}}
    <div class="text-center py-5">
        <i class="fa fa-leaf fa-3x verde mb-3 d-block"></i>
        <p class="azul-marino f600 h5">
            @if(App::currentLocale() == 'es')
                No hay ranchos certificados disponibles en este momento.
            @else
                No certified ranches available at this moment.
            @endif
        </p>
        <p class="gris small">
            @if(App::currentLocale() == 'es')
                La información se actualizará próximamente.
            @else
                Information will be updated soon.
            @endif
        </p>
    </div>

@else

    @php
        $vigentesCount = $ranchos->filter(fn($r) => $r->cert?->es_vigente)->count();
        $totalCount    = $ranchos->count();
        $vencidosCount = $totalCount - $vigentesCount;
    @endphp

    {{-- ── Barra de resumen estadístico ────────────────────────────────── --}}
    <div class="cert-resumen-bar row text-center mb-4 mx-0">
        <div class="col-4">
            <div class="cert-stat-item">
                <span class="cert-stat-num azul-marino">{{ $totalCount }}</span>
                <span class="cert-stat-label gris">
                    {{ App::currentLocale() == 'es' ? 'Ranchos' : 'Ranches' }}
                </span>
            </div>
        </div>
        <div class="col-4">
            <div class="cert-stat-item">
                <span class="cert-stat-num verde">{{ $vigentesCount }}</span>
                <span class="cert-stat-label gris">
                    {{ App::currentLocale() == 'es' ? 'Vigentes' : 'Valid' }}
                </span>
            </div>
        </div>
        <div class="col-4">
            <div class="cert-stat-item">
                <span class="cert-stat-num" style="color:#c62828;">{{ $vencidosCount }}</span>
                <span class="cert-stat-label gris">
                    {{ App::currentLocale() == 'es' ? 'Vencidos' : 'Expired' }}
                </span>
            </div>
        </div>
    </div>

    {{-- ── Grid del mosaico ──────────────────────────────────────────────── --}}
    <div class="cert-grid">

        @foreach($ranchos as $rancho)
            @php
                $cert    = $rancho->cert;
                $vigente = $cert?->es_vigente ?? false;
                $proximo = $cert?->proximo_a_vencer ?? false;
            @endphp

            <article class="cert-card
                @if($vigente && $proximo)  cert-card--proximo
                @elseif($vigente)          cert-card--vigente
                @else                      cert-card--vencido
                @endif"
                role="article"
                aria-label="{{ $rancho->nombre }}">

                {{-- ── Imagen + Badge de estado ──────────────────────── --}}
                <div class="cert-card-img-wrap">
                    <img src="{{ $rancho->imagen_url }}"
                         alt="{{ $rancho->nombre }}"
                         class="cert-card-img"
                         loading="lazy"
                         onerror="this.src='/site/img/campo-01.jpg'">

                    <div class="cert-badge
                        @if($vigente && $proximo)  cert-badge--proximo
                        @elseif($vigente)           cert-badge--vigente
                        @else                       cert-badge--vencido
                        @endif">
                        @if($vigente && $proximo)
                            <i class="fa fa-clock-o"></i>
                            {{ App::currentLocale() == 'es' ? 'Próx. a vencer' : 'Expiring soon' }}
                        @elseif($vigente)
                            <i class="fa fa-check-circle"></i>
                            {{ App::currentLocale() == 'es' ? 'Vigente' : 'Valid' }}
                        @else
                            <i class="fa fa-times-circle"></i>
                            {{ App::currentLocale() == 'es' ? 'Vencido' : 'Expired' }}
                        @endif
                    </div>
                </div>

                {{-- ── Cuerpo de la card ─────────────────────────────── --}}
                <div class="cert-card-body">

                    <h6 class="cert-card-nombre azul-marino f600">
                        {{ $rancho->nombre }}
                    </h6>

                    <p class="cert-card-ubicacion gris small mb-2">
                        <i class="fa fa-map-marker mr-1" style="color:#003CA6;" aria-hidden="true"></i>
                        {{ $rancho->ubicacion_completa ?: $rancho->ubicacion }}
                    </p>

                    @if($cert)

                        {{-- Tabla de detalles del certificado --}}
                        <div class="cert-detalles">

                            @if($cert->numero_certificado)
                                <div class="cert-fila">
                                    <span class="cert-label">
                                        {{ App::currentLocale() == 'es' ? 'N° Cert.' : 'Cert. No.' }}
                                    </span>
                                    <span class="cert-valor cert-numero">
                                        {{ $cert->numero_certificado }}
                                    </span>
                                </div>
                            @endif

                            <div class="cert-fila">
                                <span class="cert-label">
                                    {{ App::currentLocale() == 'es' ? 'Emisión' : 'Issued' }}
                                </span>
                                <span class="cert-valor">
                                    {{ $cert->fecha_emision->format('d/m/Y') }}
                                </span>
                            </div>

                            <div class="cert-fila">
                                <span class="cert-label">
                                    {{ App::currentLocale() == 'es' ? 'Vigencia' : 'Valid until' }}
                                </span>
                                <span class="cert-valor {{ !$vigente ? 'text-danger' : ($proximo ? 'cert-fecha-proximo' : '') }}">
                                    {{ $cert->fecha_vencimiento->format('d/m/Y') }}

                                    @if($vigente && !$proximo)
                                        <small class="d-block" style="opacity:.7;">
                                            {{ $cert->dias_para_vencer }}
                                            {{ App::currentLocale() == 'es' ? ' días restantes' : ' days remaining' }}
                                        </small>
                                    @elseif($proximo)
                                        <small class="d-block cert-fecha-proximo f600">
                                            ⚠
                                            {{ App::currentLocale() == 'es' ? 'Vence en ' : 'Expires in ' }}
                                            {{ $cert->dias_para_vencer }}
                                            {{ App::currentLocale() == 'es' ? ' días' : ' days' }}
                                        </small>
                                    @endif
                                </span>
                            </div>

                            @if($cert->organismo_auditor)
                                <div class="cert-fila">
                                    <span class="cert-label">
                                        {{ App::currentLocale() == 'es' ? 'Auditor' : 'Auditor' }}
                                    </span>
                                    <span class="cert-valor small">
                                        {{ $cert->organismo_auditor }}
                                    </span>
                                </div>
                            @endif

                        </div>{{-- /.cert-detalles --}}

                        {{-- Botón de descarga PDF --}}
                        @if($cert->pdf_url)
                            <a href="{{ $cert->pdf_url }}"
                               class="cert-btn-descarga {{ !$vigente ? 'cert-btn-descarga--vencido' : '' }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="{{ App::currentLocale() == 'es'
                                    ? 'Descargar certificado PDF de ' . $rancho->nombre
                                    : 'Download PDF certificate for ' . $rancho->nombre }}">
                                <i class="fa fa-file-pdf-o mr-1" aria-hidden="true"></i>
                                {{ App::currentLocale() == 'es' ? 'Descargar Certificado' : 'Download Certificate' }}
                            </a>
                        @else
                            <span class="cert-sin-pdf small gris">
                                <i class="fa fa-file-o mr-1" aria-hidden="true"></i>
                                {{ App::currentLocale() == 'es' ? 'PDF no disponible' : 'PDF not available' }}
                            </span>
                        @endif

                    @else
                        {{-- Sin datos de certificación --}}
                        <p class="small gris text-center py-3">
                            {{ App::currentLocale() == 'es'
                                ? 'Sin datos de certificación registrados.'
                                : 'No certification data registered.' }}
                        </p>
                    @endif

                </div>{{-- /.cert-card-body --}}

            </article>{{-- /.cert-card --}}

        @endforeach

    </div>{{-- /.cert-grid --}}

@endif
