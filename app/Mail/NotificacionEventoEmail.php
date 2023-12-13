<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionEventoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public $asunto;
    public $detalle;
    public $user_name;
    public $nombre_evento;
    public function __construct($asunto,$detalle,$user_name,$nombre_evento)
    {
        $this->asunto = $asunto;
        $this->detalle = $detalle;
        $this->user_name = $user_name;
        $this->nombre_evento = $nombre_evento;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notificacion-evento-email');
    }
}
