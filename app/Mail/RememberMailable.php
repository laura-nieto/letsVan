<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RememberMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject="Let's Van - Recordatorio Transferencia";
    
    public $idCompra;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idCompra,$link)
    {
        $this->idCompra = $idCompra;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.transferenciaRecordatorio');
    }
}
