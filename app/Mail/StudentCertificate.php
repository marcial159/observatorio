<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentCertificate extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $event;
    public $path;

    public function __construct($email,$name,$event,$path)
    {
        $this->email = $email;
        $this->name = $name;
        $this->event = $event;
        $this->path = $path;
    }

    public function build()
    {
        $email = $this->email;
        $name = $this->name;
        $event = $this->event;
        $path = $this->path;
        return $this->view('mails.StudentCertificate', compact('email','name','event','path'))
                    ->attach($this->path, [
                        'as' => 'Certificado.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->subject('Certificado emitido');
    }
}
