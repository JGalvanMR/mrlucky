<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $datos;
    public string $areaLabel;

    public function __construct(array $datos, string $areaLabel)
    {
        $this->datos = $datos;
        $this->areaLabel = $areaLabel;
    }

    public function build()
    {
        return $this
            // BUGFIX: antes se usaba el correo del visitante como "from",
            // lo que hace que muchos servidores SMTP rechacen o marquen como
            // spam el mensaje (falla de SPF/DKIM al enviar "desde" un dominio
            // externo). Ahora se envía desde la dirección configurada del
            // sitio y el correo del visitante va en "replyTo".
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->datos['email'], $this->datos['nombre'] ?? null)
            ->subject('Nuevo mensaje de contacto web - ' . $this->areaLabel)
            ->view('mails.contacto')
            ->with(array_merge($this->datos, ['areaLabel' => $this->areaLabel]));
    }
}
