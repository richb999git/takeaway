<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class CardPaymentReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $id;
    public $cardPaymentRef;

    public function __construct($id, $cardPaymentRef)
    {
        //
        $this->id = $id;
        $this->cardPaymentRef = $cardPaymentRef;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.card-payment-received')
                    ->with([
                        'url' => request()->getSchemeAndHttpHost()
                    ]);
    }
}
