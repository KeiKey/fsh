<?php

namespace App\Mail;

use App\Models\File\File;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SharedFile extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $file;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param File $file
     */
    public function __construct(User $user, File $file)
    {
        $this->user = $user;
        $this->file = $file;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.share')->subject('New File Share');
    }
}
