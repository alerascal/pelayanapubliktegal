<?php

namespace App\Exports;

use App\Models\PendaftaranMagang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;
    protected $tahun;
    protected $bulan;

    public function __construct($search = null, $tahun = null, $bulan = null)
    {
        $this->search = $search;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        $query = PendaftaranMagang::with('lowongan');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', "%{$this->search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('telepon', 'like', "%{$this->search}%")
                  ->orWhereHas('lowongan', function ($q2) {
                      $q2->where('judul', 'like', "%{$this->search}%");
                  });
            });
        }

        if ($this->tahun) {
            $query->whereYear('created_at', $this->tahun);
        }

        if ($this->bulan) {
            $query->whereMonth('created_at', $this->bulan);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Asal Sekolah',
            'Email',
            'Telepon',
            'Lowongan',
            'Status',
            'Tanggal Dibuat',
        ];
    }

    public function map($pendaftaran): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $pendaftaran->nama,
            $pendaftaran->asal_sekolah,
            $pendaftaran->email,
            $pendaftaran->telepon,
            $pendaftaran->lowongan->judul ?? '-',
            $pendaftaran->status ?? 'Diproses',
            $pendaftaran->created_at->format('Y-m-d H:i:s'),
        ];
    }
}