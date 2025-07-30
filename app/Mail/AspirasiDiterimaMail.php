<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Aspirasi;

class AspirasiDiterimaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aspirasi;

    public function __construct(Aspirasi $aspirasi)
    {
        $this->aspirasi = $aspirasi;
    }

    public function build()
    {
        return $this->subject('Aspirasi Anda Diterima')
                    ->view('emails.aspirasi_diterima')
                    ->with(['aspirasi' => $this->aspirasi]);
    }
}
