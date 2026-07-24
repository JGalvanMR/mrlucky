<?php

/**
 * Enrutamiento del formulario de Contacto por área (requerimiento punto 24).
 *
 * IMPORTANTE: el HTML del formulario ya NO envía una dirección de correo
 * como valor de la opción seleccionada (eso permitía que, en teoría, se
 * manipulara el destino desde el navegador). Ahora cada <option> envía una
 * CLAVE (ej. "sistemas"), y el backend resuelve esa clave a los correos
 * reales usando este archivo. Si la clave no existe aquí, la solicitud se
 * rechaza — nunca se usa un valor arbitrario del usuario como destinatario.
 *
 * Todas las direcciones son configurables por variable de entorno para no
 * hardcodear correos repetidos en varios archivos.
 */
return [

    'areas' => [
        'capital_humano' => env('CONTACTO_CAPITAL_HUMANO', 'rosa.rodriguez@mrlucky.com.mx'),
        'calidad' => env('CONTACTO_CALIDAD', 'mrhernandez@mrlucky.com.mx'),
        'proveedores' => env('CONTACTO_PROVEEDORES', 'comprasmp@mrlucky.com.mx,comprasmateriales@mrlucky.com.mx'),

        // BUGFIX detectado en auditoría: este <option> no tenía ningún correo
        // configurado (value=""), por lo que los mensajes de esta área nunca
        // llegaban a nadie. Gerencia debe confirmar/proveer el correo real de
        // "Mantenimiento" en CONTACTO_MANTENIMIENTO; mientras tanto queda null
        // y el formulario mostrará un error amigable en vez de fallar en
        // silencio o inventar un destinatario.
        'mantenimiento' => env('CONTACTO_MANTENIMIENTO', null),

        'mercadotecnia' => env('CONTACTO_MERCADOTECNIA', 'mercadotecnia@mrlucky.com.mx'),

        // BUGFIX: el <option> original tenía el correo "msamano@mrluccky.com.mx"
        // (dominio con doble "c", typo). Se corrige a mrlucky.com.mx, que es el
        // dominio usado en el resto del sitio y en el requerimiento de Gerencia.
        'recursos_humanos_2' => env('CONTACTO_RH2', 'msamano@mrlucky.com.mx'),

        'sistemas' => env('CONTACTO_SISTEMAS', 'sistemas@mrlucky.com.mx'),
        'ventas_exportacion' => env('CONTACTO_VENTAS_EXPORTACION', 'orders@mrlucky.com.mx'),

        // BUGFIX: igual que "mantenimiento" — el <option> de Ventas Nacional
        // no tenía correo configurado (value=""). Esto explica por qué los
        // correos de prueba de Gerencia para Ventas Nacional nunca llegaron.
        // Debe confirmarse el correo real en CONTACTO_VENTAS_NACIONAL.
        'ventas_nacional' => env('CONTACTO_VENTAS_NACIONAL', null),
    ],

    /*
    |--------------------------------------------------------------------------
    | Etiquetas legibles por área (clave de traducción en el grupo "contacto")
    |--------------------------------------------------------------------------
    */
    'area_labels' => [
        'capital_humano' => 'contacto.capitalhumano_label',
        'calidad' => 'contacto.calidad',
        'proveedores' => 'contacto.proveedores',
        'mantenimiento' => 'contacto.mantenimiento',
        'mercadotecnia' => 'contacto.mercadotecnia',
        'recursos_humanos_2' => 'contacto.capitalhumano_label',
        'sistemas' => 'contacto.sistemas',
        'ventas_exportacion' => 'contacto.ventasexportacion',
        'ventas_nacional' => 'contacto.ventasnacional',
    ],

];
