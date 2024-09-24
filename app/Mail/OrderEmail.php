<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($content, $data = [])
    {
        $this->content = $content;
        $this->data = $data;
    }

    public function build()
    {
        $subject = $this->getSubject();
        return $this->subject($subject)->view('email.order-email')
                    ->with(['data' => $this->data]);
    }

    protected function getSubject()
    {
        if (isset($this->data['type'])) {
            switch ($this->data['type']) {
                case 'order_confirmation':
                    return 'Order Confirmation - Order #' . $this->data['order_id'];
                case 'otp_verification':
                    return 'Your OTP Code';
                case 'register_user':
                    return 'Registration';
                default:
                    return 'Important Update from Superior Honda';
            }
        }

        return 'Important Update from Superior Honda';
    }
}
