<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = (object)$data;
        $this->senderEmail = config('mail.from.address');
        $this->senderName = config('mail.from.name');
    }

    public function build()
    {
        $data = $this->data;
        return $this->from($this->senderEmail, $this->senderName) // Set sender
                    ->subject($this->data->subject) // Set email subject
                    ->view('email.contact', [
                        'data' => $this->data,
                        'senderEmail' => $this->senderEmail,
                        'senderName' => $this->senderName
                    ]);
                   

    }
}

