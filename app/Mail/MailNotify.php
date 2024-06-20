<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    private $data = [];

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }
    public function build()
    {
        // dd($this->data);
        // exit;
        return $this->from('truongvanquanglb2016@gmail.com',"Thông tin mua hàng từ shop")
        ->subject($this->data['subject'])
        ->view("email.index")->with("data", $this->data);

    }
}
