<?php


namespace App\Channels;


use Illuminate\Notifications\Notification;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class CreateExpertPropertiesSmsChannel
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
        Smsirlaravel::ultraFastSend(['ChassisNumber'=>$message['ChassisNumber']],15423,$message['phone_number']);
    }
}