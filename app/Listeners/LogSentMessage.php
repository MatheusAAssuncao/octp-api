<?php

namespace App\Listeners;

use App\Models\Email;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;

class LogSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        try {
            $to = array_keys($event->message->getTo());
            Email::create([
                'to' => $to[0],
                'resume' => $event->message->getSubject(),
                'content' => $event->message->getBody(),
            ]);
        } catch(Exception $e) {

        }
    }
}
