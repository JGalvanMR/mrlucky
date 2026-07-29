<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Destinatarios de solicitudes de descarga de certificados
    |--------------------------------------------------------------------------
    |
    | Requerimiento de Gerencia: cuando un usuario solicita la descarga de un
    | certificado, el correo debe llegar a esta lista fija de destinatarios.
    | Se definen por variable de entorno para no hardcodear direcciones en
    | controladores ni repetirlas en varios archivos (ver punto 19 del
    | requerimiento: CERTIFICATE_REQUEST_RECIPIENTS).
    |
    | Formato en .env (separado por comas, sin espacios):
    | CERTIFICATE_REQUEST_RECIPIENTS=mrhernandez@mrlucky.com.mx,msamano@mrlucky.com.mx,mercadotecnia@mrlucky.com.mx,comprasmp@mrlucky.com.mx,adrian.ortega@mrlucky.com.mx
    |
    */
    'request_recipients' => array_filter(array_map(
        'trim',
        explode(',', env('CERTIFICATE_REQUEST_RECIPIENTS', implode(',', [
            'mrhernandez@mrlucky.com.mx',
            'msamano@mrlucky.com.mx',
            'mercadotecnia@mrlucky.com.mx',
            'comprasmp@mrlucky.com.mx',
            'adrian.ortega@mrlucky.com.mx',
            'ventas@mrlucky.com.mx',
            'orders@mrlucky.com.mx',
            'jgalvan@mrlucky.com.mx',
        ])))
    )),

    /*
    |--------------------------------------------------------------------------
    | Límite del campo "Uso"
    |--------------------------------------------------------------------------
    */
    'uso_max_length' => 500,

    /*
    |--------------------------------------------------------------------------
    | Catálogo de certificaciones generales (no ligadas a un rancho)
    |--------------------------------------------------------------------------
    |
    | Estos PDFs vivían en /public/site/certificaciones/*.pdf, accesibles
    | públicamente y descargables de forma directa (ver requerimiento punto 9
    | y 10). Se movieron al disco 'private' (storage/app/private/
    | certificaciones-generales/) y ahora se sirven únicamente a través de
    | CertificacionController@verGeneral (visor inline, sin descarga directa).
    */
    'catalogo_general' => [
        'ccof' => [
            'nombre' => 'CCOF Organic',
            'archivo' => 'certificaciones-generales/ccof.pdf',
        ],
        'c-tpat' => [
            'nombre' => 'C-TPAT',
            'archivo' => 'certificaciones-generales/c-tpat.pdf',
        ],
        'sqf' => [
            'nombre' => 'SQF',
            'archivo' => 'certificaciones-generales/sqf.pdf',
        ],
        'kosher' => [
            'nombre' => 'Kosher',
            'archivo' => 'certificaciones-generales/kosher.pdf',
        ],
        'ftusa' => [
            'nombre' => 'Fair Trade USA',
            'archivo' => 'certificaciones-generales/FTUSA_CRT.pdf',
        ],
        'smeta' => [
            'nombre' => 'SMETA',
            'archivo' => 'certificaciones-generales/smeta.pdf',
        ],
    ],

];
