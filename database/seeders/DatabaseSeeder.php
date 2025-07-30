<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seed dalam urutan yang benar
        $this->call([
            UserSeeder::class,                // Harus duluan, karena PendaftaranMagangSeeder butuh user
            LowonganMagangSeeder::class,     // Juga harus duluan
            PendaftaranMagangSeeder::class,  // Menggunakan user & lowongan
            AspirasiSeeder::class,
            AspirasiArsipSeeder::class,
            BeritaSeeder::class,
        ]);
    }
}
