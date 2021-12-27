<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class PrivateCouponMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $coupon,$store;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $coupon)
    {
        $this->user = $user;
        $this->coupon = $coupon;
        $this->store = Setting::first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pricoupon');
    }
}
