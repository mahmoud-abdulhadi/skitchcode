<?php

namespace App\Listeners;

use App\Events\ThreadHasNewComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyThreadSubscribers
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
     * @param  ThreadHasNewComment  $event
     * @return void
     */
    public function handle(ThreadHasNewComment $event)
    {
        $event->thread->notifySubscribers($event->comment);
    }
}
