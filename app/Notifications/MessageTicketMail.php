<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageTicketMail extends Notification
{
    use Queueable;
    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $data=$this->data;
        if(isset($data['remark'])){
            return (new MailMessage)
                    ->subject($data['title'])
                    ->greeting($data['title'])
                    ->line($data['message'])
                    ->lineIf(isset($data['remark']), "Remarque : {$data['remark']}");
        }else{
            return (new MailMessage)
                    ->subject($data['title'])
                    ->greeting($data['title'])
                    ->line($data['message']);
        }

                    //->action('Notification Action', url('/'))
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
