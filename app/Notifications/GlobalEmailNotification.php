<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GlobalEmailNotification extends Notification
{
    use Queueable;

    public $data;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($result, $subject, $message_one, $message_two = null, $message_three = null, $admin = null)
    {
        $this->data['logo']          = 'https://bookempire.co.uk/public/site_assets/images/logo.png';
        $this->data['subject']       = $subject;
        $this->data['message_one']   = $message_one;
        $this->data['message_two']   = $message_two;
        $this->data['message_three'] = $message_three;
        $this->data['result']        = $result;
        $this->data['name']          = $result->name;
        $this->data['address']       = $admin->address;
        $this->data['mobile_number'] = $admin->phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        try {
            return (new MailMessage)->view(
                'emails.global_email', ['data' => $this->data]
            )
            ->subject($this->data['subject']);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
