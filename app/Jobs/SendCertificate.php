<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\StudentCertificate;
use Mail;

class SendCertificate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $event;
    protected $path;

    public function __construct($email,$name,$event,$path)
    {
        $this->email = $email;
        $this->name = $name;
        $this->event = $event;
        $this->path = $path;
    }

    public function handle()
    {
        $mail = new StudentCertificate($this->email,$this->name,$this->event,$this->path);
        Mail::to($this->email)->send($mail);
    }

    public function failed(\Exception $exception)
    {
        // Send user notification of failure, etc...
    }
}
