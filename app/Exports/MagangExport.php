<?php

namespace App\Exports;

use App\Models\PendaftaranMagang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MagangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return PendaftaranMagang::with('lowongan')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Email',
            'Nomor Telepon',
            'Asal Sekolah / Kampus',
            'Judul Lowongan',
            'Status',
        ];
    }

    public function map($row): array
    {
        static $i = 0;
        return [
            ++$i,
            $row->nama,
            $row->email,
            "'" . $row->telepon, // Tambahkan tanda petik agar format tetap teks
            $row->asal_sekolah,
            $row->lowongan->judul ?? '-',
            ucfirst($row->status),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
}
