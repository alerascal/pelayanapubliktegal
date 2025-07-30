<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Ambil data laporan dari database
     */
    public function collection()
    {
        return Laporan::select('jenis', 'judul', 'status', 'tanggal_laporan')->get();
    }

    /**
     * Ubah format tampilan data per baris (misal ubah format tanggal)
     */
    public function map($row): array
    {
        return [
            $row->jenis,
            $row->judul,
            ucfirst($row->status),
            date('d-m-Y H:i', strtotime($row->tanggal_laporan)),
        ];
    }

    /**
     * Judul kolom pada file Excel
     */
    public function headings(): array
    {
        return [
            'Jenis',
            'Judul / Nama',
            'Status',
            'Waktu Laporan',
        ];
    }
}
