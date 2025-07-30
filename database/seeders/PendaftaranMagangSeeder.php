<?php

namespace Database\Seeders;

use App\Models\PendaftaranMagang;
use App\Models\User;
use App\Models\LowonganMagang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PendaftaranMagangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $userIds = User::pluck('id')->toArray();
        $lowonganIds = LowonganMagang::pluck('id')->toArray();

        if (empty($userIds) || empty($lowonganIds)) {
            $this->command->warn("Seeder gagal: User atau Lowongan belum tersedia.");
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            PendaftaranMagang::create([
                'user_id' => $faker->randomElement($userIds),
                'lowongan_id' => $faker->randomElement($lowonganIds),
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'email' => $faker->userName . '@gmail.com',
                'telepon' => '08' . $faker->numerify('##########'),
                'asal_sekolah' => $faker->randomElement([
                    'SMK Negeri 1 Tegal', 'SMA Negeri 2 Brebes', 'SMK Muhammadiyah Slawi',
                    'SMK PGRI Kota Tegal', 'SMK Negeri 3 Pemalang', 'SMA Negeri 1 Adiwerna'
                ]),
                'cv' => 'cv_' . Str::random(5) . '.pdf',
                'surat_izin' => 'izin_' . Str::random(5) . '.pdf',
                'status' => $faker->randomElement(['menunggu', 'diproses', 'diterima', 'ditolak']),
                'tahun' => now()->year,
                'tanggal_batas_kedatangan' => now()->addDays(rand(10, 60)),
            ]);
        }
    }
}
