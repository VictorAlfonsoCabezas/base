<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function build() {
        return $this->from('deysiguaman76@gmail.com', 'Intélho')
                        ->view('correo.notification')
                        ->subject('Notificación Intého')
                        ->with($this->data);
    }

}
