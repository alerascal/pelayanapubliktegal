<?php

namespace App\Exports;

use App\Models\PendaftaranMagang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AllPendaftarExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    /**
     * Ambil semua data pendaftar magang dan transformasi datanya untuk export.
     */
    public function collection()
    {
        $data = PendaftaranMagang::with('lowongan')->get();

        return $data->map(function ($item) {
            return [
                'Nama'            => $item->nama,
                'Alamat'          => $item->alamat,
                'Status'          => ucfirst($item->status),
                'Lowongan'        => $item->lowongan->judul ?? '-',
                'Tanggal Daftar'  => $item->created_at->format('d-m-Y'),
            ];
        });
    }

    /**
     * Judul kolom pada file Excel
     */
    public function headings(): array
    {
        return [
            'Nama',
            'Alamat',
            'Status',
            'Lowongan',
            'Tanggal Daftar',
        ];
    }

    /**
     * Styling header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'alignment' => ['horizontal' => 'center'],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '4a7ebb'] // Biru tua
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Auto-size kolom setelah export
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Autosize untuk semua kolom dari A sampai E
                foreach (range('A', 'E') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
