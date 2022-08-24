<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $fromWhom, $business, $sentBy)
    {
        $this->name = $name;
        $this->email = $email;
        $this->fromWhom = $fromWhom;
        $this->business = $business;
        $this->sentBy = $sentBy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject('call from | 電話がありました！')
            ->view('mails.notification_mail')
            ->with([
                'name' => $this->name,
                'fromWhom' => $this->fromWhom,
                'business' => $this->business,
                'sentBy' => $this->sentBy,
            ]);
    }
}
