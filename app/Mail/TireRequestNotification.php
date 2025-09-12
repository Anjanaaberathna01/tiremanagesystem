<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TireRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $recipient;

    public function __construct(User $sender, User $recipient)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this->subject('New Tire Request Notification')
            ->view('emails.tire_request_notification');
    }
}