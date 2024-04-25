<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Invoice;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public  $invoice;
    
    
    public function __construct( $invoice)
    {
        $this->invoice = $invoice;
       
    }
    
    public function build()
    {
        return $this->subject('Order Confirmation')->view('mail.order-mail',["invoice" => $this->invoice]);
        
    }
}
