<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\ProductOrder;

class offerte extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, ProductOrder $products)
    {

        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Offerte')->view('mail.offerte');
    }
}
