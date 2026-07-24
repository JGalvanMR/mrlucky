<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudDescargaCertificadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $datos;
    public string $nombreCertificado;
    public string|int $idCertificado;

    /**
     * @param  string      $nombreCertificado  Nombre legible del certificado solicitado
     * @param  string|int  $idCertificado      ID o slug interno del certificado
     * @param  array       $datos              Datos ya validados del formulario
     *                                         (nombre, puesto, empresa, correo, telefono, contacto_gab, uso)
     */
    public function __construct(string $nombreCertificado, string|int $idCertificado, array $datos)
    {
        $this->nombreCertificado = $nombreCertificado;
        $this->idCertificado = $idCertificado;
        $this->datos = $datos;
    }

    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->datos['correo'], $this->datos['nombre'])
            ->subject('Solicitud de descarga de certificado - ' . $this->nombreCertificado)
            ->view('mails.solicitud-descarga-certificado')
            ->with([
                'nombreCertificado' => $this->nombreCertificado,
                'idCertificado' => $this->idCertificado,
                'datos' => $this->datos,
            ]);
    }
}
