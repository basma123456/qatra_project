<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendFile extends Mailable
{
    use Queueable, SerializesModels;
    public $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message')
            ->subject('عملية إسناد جديدة')
           
            ->attachData(Storage::disk('public')->get($this->file), basename($this->file) , [
                'mime' => 'application/pdf', // Ensure correct MIME type
            ]);
    }
}
