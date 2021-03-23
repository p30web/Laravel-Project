<?php

namespace App\Notifications;

use App\Advertising;
use App\Channels\ExpertSmsChannel;
use App\Expert;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewExpertAdver extends Notification
{
    use Queueable;

    public $expert;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Expert $expert)
    {
        $this->expert = $expert;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ExpertSmsChannel::class];
    }

    /**
     * send sms to user
     *
     * @param $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        $time = json_decode($this->expert->reserve->reserveDate, true);
        return [
            'phone_number' => $notifiable->phone_number,
            'expertDate' => $time['date'],
            'expertTime' => $time['time'],
        ];
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
