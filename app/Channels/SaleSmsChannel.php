<?php


namespace App\Channels;


use Illuminate\Notifications\Notification;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class SaleSmsChannel
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
        Smsirlaravel::send($message['message'] ,$message['phone_number']);
    }
}