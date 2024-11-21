<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendParentEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $name='';
    protected $type='';
    public function __construct($name,$type)
    {
        $this->name=$name;
        $this->type=$type;
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
        switch($this->type){
            case 'createuser':return $this->mailCreateUser();
            case 'sendcontact':return $this->mailSendContact();
            default : return $this->mailCreateUser();
        }
    }
    public function mailCreateUser():MailMessage{
        
        return (new MailMessage)
                    ->line("Bonjour/Bonsoir Monsieur/Madame $this->name, Bienvenue dans MikrotekWfi, vous pouvez vous connecter a votre page admin avec vos informations de connexion ")
                    ->action('cliquer sur ce lien pour aller sur la page admin', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function mailSendContact():MailMessage{
        
        return (new MailMessage)
                    ->line("Bonjour/Bonsoir monsieur l'administrateur, l'utilisateur : $this->name vient de vous laisser un mail")
                    ->action('allez sur la page admin', url('/'));
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
