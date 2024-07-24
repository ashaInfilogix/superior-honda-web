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
        return $this->view('email.order-email')
                    ->with(['data' => $this->data]);
    }
}
