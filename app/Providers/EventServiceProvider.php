<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ThreadHasNewComment' => [
            'App\Listeners\NotifyThreadSubscribers',
            
        ],
        'App\Events\CommentableHasNewComment' =>[
            'App\Listeners\NotifyMentionedUsers'
        ],
        'App\Events\WorkspaceHasNewParticipant' => [
                'App\Listeners\NotifyParticipants'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
