<?php

namespace App\Listeners;

use App\Events\WorkspaceHasNewParticipant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyParticipants
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
     * @param  WorkspaceHasNewParticipant  $event
     * @return void
     */
    public function handle(WorkspaceHasNewParticipant $event)
    {
        
        $event->workspace->notifyParticipants($event->user) ; 
    }
}
