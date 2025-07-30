<?php

namespace App\Exports;

use App\Models\Aspirasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AspirasiExport implements FromCollection, WithHeadings, WithMapping
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
        $query = Aspirasi::with('user');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', "%{$this->search}%")
                  ->orWhere('isi', 'like', "%{$this->search}%")
                  ->orWhere('alamat', 'like', "%{$this->search}%")
                  ->orWhereHas('user', function ($q2) {
                      $q2->where('name', 'like', "%{$this->search}%");
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
            'Judul',
            'Nama Pengguna',
            'Isi',
            'Alamat',
            'Status',
            'Tanggal Dibuat',
        ];
    }

    public function map($aspirasi): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $aspirasi->judul,
            $aspirasi->user->name ?? '-',
            $aspirasi->isi,
            $aspirasi->alamat,
            $aspirasi->status ?? 'Diproses',
            $aspirasi->created_at->format('Y-m-d H:i:s'),
        ];
    }
}