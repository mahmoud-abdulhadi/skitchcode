<?php

namespace App\Listeners;

use App\Events\CommentableHasNewComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User ; 

use App\Notifications\YouWereMentioned ; 

class NotifyMentionedUsers
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
    public function handle(CommentableHasNewComment $event)
    {
        
            
          User::whereIn('username',$event->comment->mentionedUsers())
                    ->get()
                    ->each(function($user) use ($event) {

                    $user->notify(new YouWereMentioned($event->comment)); 
                });


    }
}
