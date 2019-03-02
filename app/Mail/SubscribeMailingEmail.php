<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeMailingEmail extends Mailable
{
    use Queueable, SerializesModels;

      public $post;

    /**
     * Create a new message instance.
     *
     * @param $post
     */
    public function __construct($post)
    {
        $this->post  = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('romanbalickil9@gmail.com','travel blog')
            ->subject('Your reminder!')
            ->view('email.sub_mailing');
    }
}
