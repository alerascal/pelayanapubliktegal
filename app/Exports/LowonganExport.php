<?php

namespace App\Exports;
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LowonganExport implements FromView
{
    protected $lowongan;

    public function __construct($lowongan)
    {
        $this->lowongan = $lowongan;
    }

    public function view(): View
    {
        return view('pages.backend.magang.export_lowongan_excel', [
            'lowongan' => $this->lowongan
        ]);
    }
}
