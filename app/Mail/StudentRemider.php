<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentRemider extends Mailable
{
    use Queueable, SerializesModels;

    public $body;

    public function __construct($body)
    {
        $this->body  = $body;
    }

    public function build()
    {
        $body = $this->body;
        return $this->view('mails.StudentRemider',compact('body'))
                    ->subject('Recordatorio ITEC123');
    }
}
