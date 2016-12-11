<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\SmscRu\SmscRuMessage;
use NotificationChannels\SmscRu\SmscRuChannel;

class StatusResearch extends Notification
{
    use Queueable;

    protected $patient_research;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($patient_research = null)
    {
        $this->patient_research = $patient_research;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
         return [SmscRuChannel::class];
    }

    public function toSmscRu($notifiable)
    {
        $send_text = "Здравствуйте, ".$notifiable->getFio()."! \nВаш результат исследования ".$this->patient_research->research->name." №".$this->patient_research->id." от ".$this->patient_research->create_date." готов.";

        return SmscRuMessage::create($send_text);
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
                    ->action('Notification Action', 'https://laravel.com')
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
            //
        ];
    }
}
