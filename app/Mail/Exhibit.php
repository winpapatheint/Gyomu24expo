<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Exhibit extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->senderEmail = config('mail.from.address');
        $this->senderName = config('mail.from.name');
    }

    public function build()
    {
        $data = $this->data;

        return $this->from($this->senderEmail, $this->senderName) // Set sender
                    ->subject($this->data->subject ?? $this->data->name) // Set email subject
                    ->view('email.exhibit', [
                        'data' => $this->data,
                        'senderEmail' => $this->senderEmail,
                        'senderName' => $this->senderName
                    ]);
                   

    }
}

