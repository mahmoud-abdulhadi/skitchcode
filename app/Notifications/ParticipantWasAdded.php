<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Workspace ; 

use App\User ; 

class ParticipantWasAdded extends Notification
{
    use Queueable;
    public $user ; 
    public $workspace ; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Workspace $workspace,User $user)
    {
        $this->workspace = $workspace ; 

        $this->user = $user ; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "<img  src={$this->user->avatar} width='30' height='30'/>&nbsp;<strong><em>" . $this->user->name . '</em></strong> Was Added to Workspace <strong><em>' . $this->workspace->title . '</em></strong>',
            //to do make a path to reply
            'link' => $this->workspace->path()
        ];
    }
}
