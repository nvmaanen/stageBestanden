<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class confirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $items;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $items, Order $order)
    {
        $this->customer = $customer;
        $this->items = $items;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bestellings overzicht')->view('mail.mail');
    }
}
