<?php


namespace App\Channels;


use Illuminate\Notifications\Notification;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class ExpertSmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        Smsirlaravel::ultraFastSend(['expertDate'=>$message['expertDate'] , 'expertTime'=>$message['expertTime']],15420,$message['phone_number']);
    }
}