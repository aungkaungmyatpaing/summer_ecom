<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlaceOrderMilable extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

  /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Order Placed Successfully, Thank You";
        return $this->subject($subject)->view('frontend.users.invoice.mail-invoice') ->with([
            'order' => $this->order,
        ]);
    }
}
