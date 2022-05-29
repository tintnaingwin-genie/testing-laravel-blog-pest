<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExternalPostSuggestedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $title,
        public string $url,
    ) {
    }

    public function build()
    {
        return $this->markdown('mails.suggestion-added', [
            'title' => $this->title,
            'url' => $this->url,
        ]);
    }
}
