<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendUserNotification
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
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        $author = $event->author_name;
        $email = $event->author_email;

        Mail::send('email.user_notification', ['name' => $author], function ($msg) use ($email, $author) {
            $msg->from('admin@mytest.com', 'Admin');
            $msg->to($email, $author);
            $msg->subject('Thank for the Quote');
        });
    }
}
