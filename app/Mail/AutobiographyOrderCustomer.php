<?php

namespace App\Mail;

use App\Models\AutobiographyOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutobiographyOrderCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $binding_order_id;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($binding_order_id)
    {
        $this->binding_order_id = $binding_order_id;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $binding_order = AutobiographyOrder::where('id',$this->binding_order_id)->firstOrFail();
        return $this->subject('Autobiography Order '.$binding_order->order_number.' From Book Empire')
                    ->view('emails.autobiography-order-customer')->with([
                        'binding_order' => $binding_order
                    ]);
    }
}
