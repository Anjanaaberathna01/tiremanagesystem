<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TireOrder;

class TireArrivedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(TireOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Your Tire Order Has Arrived')
            ->markdown('emails.tire_arrived');
    }
}