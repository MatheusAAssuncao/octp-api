<?php

namespace App\Mail;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class Email
{
    private $to = "";
    private $subject = "";
    private $content = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to, $subject, $content)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function send($save = true) {
        $html = $this->content;
        Mail::send([], [], function (Message $message) use ($html) {
            $message->to($this->to)
                ->subject($this->subject)
                ->setBody($html, 'text/html');
        });
    }
}
