<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class SendProofToClientNotification extends Notification
{
    use Queueable;

    public $data;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($result, $subject, $message_one, $message_two = null, $message_three = null)
    {
        $this->data['logo']          = 'https://bookempire.co.uk/public/site_assets/images/logo.png';
        $this->data['subject']       = $subject;
        $this->data['message_one']   = $message_one;
        $this->data['message_two']   = $message_two;
        $this->data['message_three'] = $message_three;
        $this->data['result']        = $result;
        $this->data['name']          = $result->name;
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

        $file_one = URL::asset('storage/'.$this->data['result']->inner_pdf);
        $file_two = URL::asset('storage/'.$this->data['result']->cover_pdf);
        try {
            return (new MailMessage)->view(
                'emails.attachment', ['data' => $this->data]
            )
            ->subject($this->data['subject'])
			->attach($file_one, [
                'as'   => $this->data['result']->inner_pdf,
                'mime' => 'text/pdf',
            ])
			->attach($file_two, [
                'as'   => $this->data['result']->cover_pdf,
                'mime' => 'text/pdf',
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        // return (new MailMessage)
        //             ->greeting('Dear'.' '.$this->data['name'])
        //             ->line('Please check the Proof attached in email, and after you are satisfied with it, please click on the below link to approve the same.')
        //             ->attach(url('storage').'/'.$this->data['inner_pdf'])
        //             ->attach(url('storage').'/'.$this->data['cover_pdf'])
        //             ->action('Go To', route('site.approve').'/'.$this->data['email'].'/'.$this->data['otp']);
    }
}
