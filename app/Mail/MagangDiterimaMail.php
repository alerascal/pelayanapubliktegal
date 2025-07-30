<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PendaftaranMagang;
use Carbon\Carbon;

class MagangDiterimaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;
    public $start;
    public $end;

    /**
     * Create a new message instance.
     */
    public function __construct(PendaftaranMagang $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;

        // Menghitung tanggal mulai magang (hari kerja setelah updated_at)
        $start = Carbon::parse($pendaftaran->updated_at)->addDay();
        while ($start->isWeekend()) {
            $start->addDay();
        }

        // Menghitung tanggal akhir magang (6 hari kerja dari start)
        $end = $start->copy();
        $days = 1;
        while ($days < 7) {
            $end->addDay();
            if (!$end->isWeekend()) {
                $days++;
            }
        }

        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Selamat! Anda Diterima Magang')
                    ->view('emails.magang_diterima')
                    ->with([
                        'pendaftaran' => $this->pendaftaran,
                        'start'       => $this->start,
                        'end'         => $this->end,
                    ]);
    }
}
