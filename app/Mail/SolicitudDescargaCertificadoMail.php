<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudDescargaCertificadoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param string $nombreCertificado Nombre legible del certificado solicitado
     * @param string|int $idCertificado ID o slug interno del certificado
     * @param array $datos Datos validados del formulario
     */
    public function __construct(
        public string $nombreCertificado,
        public string|int $idCertificado,
        public array $datos
    ) {}

    /**
     * Construye el mensaje de correo.
     */
    public function build(): static
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->datos['correo'], $this->datos['nombre'])
            ->subject('Solicitud de descarga de certificado - ' . $this->nombreCertificado)
            ->view('mails.solicitud-descarga-certificado')
            ->with([
                'nombreCertificado' => $this->nombreCertificado,
                'idCertificado'     => $this->idCertificado,
                'datos'             => $this->datos,
            ]);
    }
}
