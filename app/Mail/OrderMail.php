<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\invoice;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public invoice $invoice;

   
    
    public function __construct(invoice $invoice)
    {
        $this->invoice= $invoice;
        //
    }
 

    public function build()
    {
        return $this -> subject('Order Confirmation')->view('mail.order-mail');
    }
}