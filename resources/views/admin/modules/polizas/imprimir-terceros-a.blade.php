<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carátula de la póliza</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <style>
        *{ font-family: 'Roboto', sans-serif; font-weight: 500; }
    </style>
</head>
<body style="margin: 0; padding: 0;">
    <div class="caratula" style="position: relative;">
        <img src="{{ asset('caratulas/tipo-a.jpg') }}" style="width: 1100px;">
        
        {{-- Nombre --}}
        <span style="position: absolute; top: 178px; left: 62px; font-size: 18px">{{ $poliza->cliente->nombre ?? '--' }} {{ $poliza->cliente->apellido_paterno ?? '' }} {{ $poliza->cliente->apellido_materno ?? '' }}</span>
        
        {{-- Teléfono --}}
        <span style="position: absolute; top: 178px; left: 790px; font-size: 18px">{{ $poliza->cliente->telefono ?? '--' }}</span>

        {{-- Dirección --}}
        <span style="position: absolute; top: 230px; left: 62px; font-size: 18px">{{ $poliza->cliente->direccion ?? '--' }}, Col. {{ $poliza->cliente->colonia ?? '--' }}, CP {{ $poliza->cliente->codigo_postal ?? '--' }} </span>

        {{-- Correo --}}
        <span style="position: absolute; top: 230px; left: 790px; font-size: 18px">{{ $poliza->cliente->correo ?? '--' }}</span>

        {{-- Estado --}}
        <span style="position: absolute; top: 285px; left: 62px; font-size: 18px">{{ $poliza->cliente->ciudad->estado->estado ?? '--' }} </span>

        {{-- Ciudad --}}
        <span style="position: absolute; top: 285px; left: 317px; font-size: 18px">{{ $poliza->cliente->ciudad->ciudad ?? '--' }} </span>

        {{-- Núm. Póliza --}}
        <span style="position: absolute; top: 285px; left: 587px; font-size: 18px">{{ $poliza->num_poliza ?? '--' }} </span>

        {{-- Marca --}}
        <span style="position: absolute; top: 419px; left: 62px; font-size: 18px">{{ $poliza->submarca->marca->nombre ?? '--' }} </span>

        {{-- Submarca --}}
        <span style="position: absolute; top: 419px; left: 267px; font-size: 18px">{{ $poliza->submarca->nombre ?? '--' }} </span>

        {{-- Modelo --}}
        <span style="position: absolute; top: 419px; left: 472px; font-size: 18px">{{ $poliza->modelo ?? '--' }} </span>

        {{-- Núm. de serie --}}
        <span style="position: absolute; top: 419px; left: 643px; font-size: 18px">{{ $poliza->sum_serie ?? '--' }} </span>

        {{-- Color --}}
        <span style="position: absolute; top: 472px; left: 62px; font-size: 18px">{{ $poliza->color ?? '--' }} </span>

        {{-- Placas --}}
        <span style="position: absolute; top: 472px; left: 306px; font-size: 18px">{{ $poliza->placas ?? '--' }} </span>

        {{-- Motor --}}
        <span style="position: absolute; top: 472px; left: 552px; font-size: 18px">{{ $poliza->num_motor ?? '--' }} </span>

        {{-- Capacidad --}}
        <span style="position: absolute; top: 472px; left: 832px; font-size: 18px">{{ $poliza->capacidad ?? '--' }} </span>

        {{-- Tipo de póliza --}}
        <span style="position: absolute; top: 599px; left: 62px; font-size: 18px">
            @switch($poliza->tipo)
                @case('anu')
                    Anual
                    @break
                @case('sem')
                    Semestral
                    @break
                @case('tri')
                    Trimestral
                    @break
                @case('men')
                    Mensual
                    @break
                @default
                    --
            @endswitch
        </span>

        {{-- Fecha de alta --}}
        <span style="position: absolute; top: 599px; left: 350px; font-size: 18px">
            @if($poliza->vigencia_inicio)
                {{ date('d/m/Y', strtotime($poliza->vigencia_inicio)) }}
            @else
                --
            @endif
        </span>

        {{-- Fecha de vencimiento --}}
        <span style="position: absolute; top: 599px; left: 700px; font-size: 18px">
            @if($poliza->vigencia_fin)
                {{ date('d/m/Y', strtotime($poliza->vigencia_fin)) }}
            @else
                --
            @endif
        </span>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>