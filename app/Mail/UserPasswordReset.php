<?php
namespace App\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\User;
use Carbon\Carbon;

class UserPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct(User $user,$token)
    {
        $this->user  = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('mails.UserPasswordReset')
                    ->subject('Reseteo de contraseña');
    }
}