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
        <img src="{{ asset('caratulas/recibo.jpg') }}" style="width: 1100px;">
        
        {{-- Nombre --}}
        <span style="position: absolute; top: 250px; left: 170px; font-size: 18px">{{ $pago->vigencia->poliza->cliente->nombre ?? '--' }} {{ $pago->vigencia->poliza->cliente->apellido_paterno ?? '' }} {{ $pago->vigencia->poliza->cliente->apellido_materno ?? '' }}</span>

        {{-- Fecha de pago --}}
        <span style="position: absolute; top: 250px; left: 800px; font-size: 18px">
            @if($pago->fecha_pago)
                {{ date('d/m/Y', strtotime($pago->fecha_pago)) }}
            @else
                --
            @endif
        </span>

        {{-- Método de pago --}}
        <span style="position: absolute; top: 400px; left: 70px; font-size: 18px">
            - Método de pago 

            @switch($pago->metodo_pago)
                @case('efe')
                    "Efectivo"
                    @break
                @case('dep')
                    "Depósito"
                    @break
                @case('tra')
                    "Transferencia"
                    @break
                @case('tar')
                    "Tarjéta de Débito/Crédito"
                    @break
            @endswitch
        </span>

        {{-- Subtotal --}}
        <span style="position: absolute; top: 400px; left: 910px; font-size: 18px">
            @if($pago->monto)
                ${{ number_format($pago->monto,2) }}
            @else
                --
            @endif
        </span>

        {{-- Total --}}
        <span style="position: absolute; top: 810px; left: 910px; font-size: 18px">
            @if($pago->monto)
                ${{ number_format($pago->monto,2) }}
            @else
                --
            @endif
        </span>

        {{-- Comentario --}}
        <span style="position: absolute; top: 780px; left: 70px; font-size: 18px; width: 580px; display: inline-block;">
            {!! $pago->comentario ?? '--' !!}
        </span>


        
        
    </div>

    <script>
        window.print();
    </script>
</body>
</html>