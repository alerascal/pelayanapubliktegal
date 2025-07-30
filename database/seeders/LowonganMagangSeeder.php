<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\LowonganMagang;
use Illuminate\Support\Facades\DB;

class LowonganMagangSeeder extends Seeder
{
   public function run(): void
{
    // Hapus data anak terlebih dahulu
    DB::table('pendaftaran_magang')->delete();

    // Lalu hapus data lowongan
    DB::table('lowongan_magang')->delete();

    // Lanjut insert seperti biasa...

        
        $lowongans = [
            [
                'judul' => 'Magang Administrasi Umum',
                'deskripsi' => 'Membantu pengelolaan surat masuk dan keluar di Sekretariat DPRD.',
                'periode' => 'Juli - September 2025',
                'kuota' => 3,
                'deadline' => Carbon::now()->addDays(10),
            ],
            [
                'judul' => 'Magang Dokumentasi & Publikasi',
                'deskripsi' => 'Membantu dokumentasi kegiatan DPRD dan publikasi melalui media sosial resmi.',
                'periode' => 'Agustus - Oktober 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(15),
            ],
            [
                'judul' => 'Magang Pengarsipan Digital',
                'deskripsi' => 'Mengelola arsip digital dan membantu konversi dokumen fisik ke digital.',
                'periode' => 'Juli - September 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(7),
            ],
            [
                'judul' => 'Magang IT Support',
                'deskripsi' => 'Membantu instalasi, troubleshooting, dan maintenance perangkat kerja DPRD.',
                'periode' => 'September - November 2025',
                'kuota' => 1,
                'deadline' => Carbon::now()->addDays(20),
            ],
            [
                'judul' => 'Magang Kehumasan',
                'deskripsi' => 'Membantu pelaksanaan tugas-tugas kehumasan dan penyusunan press release.',
                'periode' => 'Juli - Agustus 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(12),
            ],
            [
                'judul' => 'Magang Data & Statistik',
                'deskripsi' => 'Membantu pengolahan data aspirasi masyarakat dan statistik kunjungan.',
                'periode' => 'Juli - September 2025',
                'kuota' => 3,
                'deadline' => Carbon::now()->addDays(5),
            ],
            [
                'judul' => 'Magang Desain Grafis',
                'deskripsi' => 'Membantu membuat konten visual, infografik, dan media presentasi DPRD.',
                'periode' => 'Agustus - Oktober 2025',
                'kuota' => 1,
                'deadline' => Carbon::now()->subDays(2), // expired
            ],
            [
                'judul' => 'Magang Protokoler',
                'deskripsi' => 'Terlibat dalam penyambutan tamu dan pengaturan acara resmi DPRD.',
                'periode' => 'Agustus - September 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(18),
            ],
            [
                'judul' => 'Magang Hukum & Perundang-undangan',
                'deskripsi' => 'Membantu penelitian dan penyusunan draft produk hukum daerah.',
                'periode' => 'September - November 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(21),
            ],
            [
                'judul' => 'Magang Keuangan & Anggaran',
                'deskripsi' => 'Membantu rekapitulasi keuangan kegiatan DPRD.',
                'periode' => 'Juli - Agustus 2025',
                'kuota' => 1,
                'deadline' => Carbon::now()->addDays(8),
            ],
            [
                'judul' => 'Magang Audio Visual',
                'deskripsi' => 'Membantu proses dokumentasi video dan audio dalam rapat dan kegiatan DPRD.',
                'periode' => 'Agustus - Oktober 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(6),
            ],
            [
                'judul' => 'Magang Sekretariat Fraksi',
                'deskripsi' => 'Membantu sekretariat dalam mendukung kegiatan anggota fraksi.',
                'periode' => 'Juli - September 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(9),
            ],
            [
                'judul' => 'Magang IT Developer',
                'deskripsi' => 'Ikut mengembangkan sistem informasi berbasis web DPRD Kota Tegal.',
                'periode' => 'September - November 2025',
                'kuota' => 1,
                'deadline' => Carbon::now()->addDays(25),
            ],
            [
                'judul' => 'Magang Dokumentasi Rapat',
                'deskripsi' => 'Mencatat jalannya rapat dan membantu membuat notulensi.',
                'periode' => 'Agustus - Oktober 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->addDays(4),
            ],
            [
                'judul' => 'Magang Analisis Kebijakan Publik',
                'deskripsi' => 'Membantu analisis isu-isu strategis yang disampaikan masyarakat ke DPRD.',
                'periode' => 'Juli - September 2025',
                'kuota' => 2,
                'deadline' => Carbon::now()->subDays(1), // expired
            ],
        ];

        foreach ($lowongans as $data) {
            $data['tahun'] = Carbon::parse($data['deadline'])->year;
            LowonganMagang::create($data);
        }
    }
}
