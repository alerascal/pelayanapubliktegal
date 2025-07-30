<?php

namespace App\Exports;

use App\Models\Aspirasi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllCombinedExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;
    protected $tahun;
    protected $bulan;

    public function __construct(?string $search = null, ?int $tahun = null, ?int $bulan = null)
    {
        $this->search = $search;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function collection(): Collection
    {
        // Query untuk Aspirasi
        $aspirasiQuery = Aspirasi::with('user')->select('id', 'judul', 'isi', 'alamat', 'status', 'created_at', 'user_id');
        $magangQuery = PendaftaranMagang::with('lowongan')->select('id', 'nama', 'email', 'asal_sekolah', 'status', 'created_at', 'lowongan_id');

        // Filter berdasarkan pencarian
        if ($this->search) {
            $aspirasiQuery->where(function ($query) {
                $query->where('judul', 'like', "%{$this->search}%")
                    ->orWhere('isi', 'like', "%{$this->search}%")
                    ->orWhere('alamat', 'like', "%{$this->search}%")
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
            });

            $magangQuery->where(function ($query) {
                $query->where('nama', 'like', "%{$this->search}%")
                    ->orWhere('asal_sekolah', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhereHas('lowongan', fn ($q) => $q->where('judul', 'like', "%{$this->search}%"));
            });
        }

        // Filter berdasarkan tahun
        if ($this->tahun) {
            $aspirasiQuery->whereYear('created_at', $this->tahun);
            $magangQuery->whereYear('created_at', $this->tahun);
        }

        // Filter berdasarkan bulan
        if ($this->bulan) {
            $aspirasiQuery->whereMonth('created_at', $this->bulan);
            $magangQuery->whereMonth('created_at', $this->bulan);
        }

        // Ambil data dan tambahkan tipe
        $aspirasiItems = $aspirasiQuery->get()->map(fn ($item) => $item->setAttribute('tipe', 'aspirasi'));
        $magangItems = $magangQuery->get()->map(fn ($item) => $item->setAttribute('tipe', 'magang'));

        // Gabungkan dan urutkan berdasarkan created_at
        return $aspirasiItems->concat($magangItems)->sortByDesc('created_at')->values();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tipe',
            'Judul',
            'Nama',
            'Email',
            'Detail',
            'Status',
            'Tanggal Dibuat',
        ];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return $item->tipe === 'aspirasi'
            ? [
                $no,
                'Aspirasi',
                $item->judul ?? '-',
                $item->user->name ?? '-',
                $item->user->email ?? '-',
                $item->isi ?? '-',
                $item->status ?? 'Diproses',
                $item->created_at->format('Y-m-d H:i:s'),
            ]
            : [
                $no,
                'Magang',
                $item->lowongan->judul ?? '-',
                $item->nama ?? '-',
                $item->email ?? '-',
                $item->asal_sekolah ?? '-',
                $item->status ?? 'Diproses',
                $item->created_at->format('Y-m-d H:i:s'),
            ];
    }
}