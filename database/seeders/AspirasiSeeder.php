<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AspirasiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user yang tersedia
        $userIds = User::pluck('id')->toArray();

        // Daftar status yang valid
        $statuses = ['menunggu', 'diproses', 'diterima', 'ditolak', 'selesai', 'hangus'];

        // Daftar contoh judul aspirasi
        $judulExamples = [
            'Permintaan Perbaikan Jalan', 'Usulan Pembangunan Taman', 'Keluhan Sampah Menumpuk',
            'Peningkatan Fasilitas Sekolah', 'Pembangunan Lampu Jalan', 'Pengaduan Kebocoran Pipa',
            'Usulan Program Kesehatan Gratis', 'Permintaan Renovasi Pasar', 'Keluhan Banjir',
            'Peningkatan Keamanan Lingkungan', 'Usulan Pelatihan UMKM', 'Permintaan Beasiswa',
            'Keluhan Listrik Sering Padam', 'Usulan Pembangunan Jembatan', 'Permintaan Fasilitas Olahraga',
            'Pengaduan Pelayanan Publik', 'Usulan Program Lingkungan', 'Permintaan Perbaikan Saluran Air',
            'Keluhan Transportasi Umum', 'Usulan Kegiatan Budaya'
        ];

        // Daftar contoh alamat
        $alamatExamples = [
            'Jl. Merdeka', 'Jl. Sudirman', 'Jl. Gatot Subroto', 'Jl. Diponegoro', 'Jl. Ahmad Yani',
            'Jl. Pahlawan', 'Jl. Veteran', 'Jl. Thamrin', 'Jl. Imam Bonjol', 'Jl. Siliwangi',
            'Jl. Cendrawasih', 'Jl. Melati', 'Jl. Mawar', 'Jl. Anggrek', 'Jl. Kenanga',
            'Jl. Flamboyan', 'Jl. Raya Indah', 'Jl. Harmoni', 'Jl. Sejahtera', 'Jl. Makmur'
        ];

        // Tentukan rentang bulan (3 bulan ke belakang dari Juli 2025)
        $months = [
            Carbon::create(2025, 5, 1), // Mei 2025
            Carbon::create(2025, 6, 1), // Juni 2025
            Carbon::create(2025, 7, 1), // Juli 2025
        ];

        foreach ($months as $month) {
            for ($i = 1; $i <= 20; $i++) {
                // Tentukan tanggal acak dalam bulan tersebut
                $randomDay = rand(1, $month->daysInMonth);
                $createdAt = $month->copy()->setDay($randomDay)->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

                Aspirasi::create([
                    'judul'     => $judulExamples[array_rand($judulExamples)] . ' ' . $month->format('F Y') . ' #' . $i,
                    'isi'       => 'Ini adalah isi dari ' . $judulExamples[array_rand($judulExamples)] . ' yang diajukan pada bulan ' . $month->format('F Y') . '. Aspirasi ini bertujuan untuk meningkatkan kualitas hidup masyarakat di sekitar wilayah tersebut.',
                    'alamat'    => $alamatExamples[array_rand($alamatExamples)] . ' No. ' . rand(1, 100),
                    'status'    => $statuses[array_rand($statuses)],
                    'user_id'   => $userIds[array_rand($userIds)],
                    'lampiran'  => rand(0, 1) ? 'lampiran-' . Str::random(8) . '.pdf' : null, // Lampiran acak (ada/tidak)
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        }
    }
}