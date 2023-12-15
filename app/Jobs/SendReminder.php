<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\StudentRemider;
use Mail;

class SendReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $body;

    public function __construct($email,$body)
    {
        $this->email = $email;
        $this->body = $body;
    }

    public function handle()
    {
        $mail = new StudentRemider($this->body);
        Mail::to($this->email)->send($mail);
    }

    public function failed(\Exception $exception)
    {
        // Send user notification of failure, etc...
    }
}
