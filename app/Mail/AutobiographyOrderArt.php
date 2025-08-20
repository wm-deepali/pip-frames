<?php

namespace App\Mail;

use App\Models\AutobiographyBindingTypeImage;
use App\Models\AutobiographyOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class AutobiographyOrderArt extends Mailable
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
		$binding_image = AutobiographyBindingTypeImage::where('autobiography_binding_type_id',$binding_order->autobiography_binding_type_id)->where('autobiography_colour_id',$binding_order->autobiography_colour_id)->first();
		$extra_accessories = json_decode($binding_order->extra_accessories_json);
		$extras = [];
		if(is_array($extras)) {	
			foreach($extra_accessories as $extra_accessory) {
				$extras = Arr::prepend($extras, $extra_accessory->name);
			}
		}
        return $this->subject('Autobiography Order Art '.$binding_order->order_number.' From Book Empire')
                    ->view('emails.autobiography-order-art')->with([
                        'binding_order' => $binding_order,
			            'binding_image' => $binding_image,
			            'extras' => $extras
                    ]);
    }
}
