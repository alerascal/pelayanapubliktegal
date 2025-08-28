<?php

namespace Database\Seeders;

use App\Models\PendaftaranMagang;
use App\Models\User;
use App\Models\LowonganMagang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PendaftaranMagangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data user dari UserSeeder
        $users = [
            [
                'name' => 'Admin DPRD Tegal 2',
                'email' => 'admin2@tegal.com',
                'nik' => '3201012000010002',
                'phone' => '081234567802',
                'alamat' => 'Jl. Merdeka No. 2',
                'role' => 'admin',
                'is_banned' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'Admin DPRD Tegal 3',
                'email' => 'admin3@tegal.com',
                'nik' => '3201012000010003',
                'phone' => '081234567803',
                'alamat' => 'Jl. Merdeka No. 3',
                'role' => 'admin',
                'is_banned' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'Admin DPRD Tegal 4',
                'email' => 'admin4@tegal.com',
                'nik' => '3201012000010004',
                'phone' => '081234567804',
                'alamat' => 'Jl. Merdeka No. 4',
                'role' => 'admin',
                'is_banned' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'Admin DPRD Tegal 5',
                'email' => 'admin5@tegal.com',
                'nik' => '3201012000010005',
                'phone' => '081234567805',
                'alamat' => 'Jl. Merdeka No. 5',
                'role' => 'admin',
                'is_banned' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'User Biasa 1',
                'email' => 'user1@tegal.com',
                'nik' => '3201022000010001',
                'phone' => '081234567811',
                'alamat' => 'Jl. Ahmad Yani No. 1',
                'role' => 'user',
                'is_banned' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'User Biasa 2',
                'email' => 'user2@tegal.com',
                'nik' => '3201022000010002',
                'phone' => '081234567812',
                'alamat' => 'Jl. Ahmad Yani No. 2',
                'role' => 'user',
                'is_banned' => true, // User ini banned
                'created_at' => now(),
            ],
            [
                'name' => 'User Biasa 3',
                'email' => 'user3@tegal.com',
                'nik' => '3201022000010003',
                'phone' => '081234567813',
                'alamat' => 'Jl. Ahmad Yani No. 3',
                'role' => 'user',
                'is_banned' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'moh sahrul alamsyah',
                'email' => 'alerascal77@gmail.com',
                'nik' => '3376011304030003',
                'phone' => '82220668915',
                'alamat' => null,
                'role' => 'user',
                'is_banned' => false,
                'created_at' => Carbon::parse('2025-07-29'),
            ],
            [
                'name' => 'ale',
                'email' => 'alerascal66@gmail.com',
                'nik' => '3376011304030009',
                'phone' => '085176728844',
                'alamat' => null,
                'role' => 'user',
                'is_banned' => false,
                'created_at' => Carbon::parse('2025-07-29'),
            ],
        ];

        // Insert users ke tabel users dan ambil ID-nya
        $userIds = [];
        foreach ($users as $index => $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'nik' => $userData['nik'],
                    'phone' => $userData['phone'],
                    'alamat' => $userData['alamat'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'),
                    'remember_token' => Str::random(10),
                    'role' => $userData['role'],
                    'is_banned' => $userData['is_banned'],
                    'created_at' => $userData['created_at'],
                    'updated_at' => $userData['created_at'],
                ]
            );
            $userIds[$index] = $user->id;
        }

        // Ambil ID lowongan dari tabel lowongan_magang
        $lowonganIds = LowonganMagang::pluck('id')->toArray();

        if (empty($lowonganIds)) {
            $this->command->warn("Seeder gagal: Lowongan belum tersedia. Jalankan LowonganMagangSeeder terlebih dahulu.");
            return;
        }

        // Ambil hanya user yang tidak banned untuk pendaftaran
        $activeUsers = array_filter($users, function ($user) {
            return !$user['is_banned'];
        });
        $activeUserIds = array_filter($userIds, function ($index) use ($users) {
            return !$users[$index]['is_banned'];
        }, ARRAY_FILTER_USE_KEY);

        // Clear existing data in pendaftaran_magang table
        \DB::table('pendaftaran_magang')->delete();

        // Buat 50 data pendaftaran magang
        for ($i = 0; $i < 50; $i++) {
            $randomUserIndex = array_rand($activeUsers);
            $userData = $activeUsers[$randomUserIndex];
            $userId = $activeUserIds[$randomUserIndex];

            PendaftaranMagang::create([
                'user_id' => $userId,
                'lowongan_id' => $faker->randomElement($lowonganIds),
                'nama' => $userData['name'],
                'alamat' => $userData['alamat'] ?? $faker->address,
                'email' => $userData['email'],
                'telepon' => $userData['phone'],
                'asal_sekolah' => $faker->randomElement([
                    'SMK Negeri 1 Tegal', 'SMA Negeri 2 Brebes', 'SMK Muhammadiyah Slawi',
                    'SMK PGRI Kota Tegal', 'SMK Negeri 3 Pemalang', 'SMA Negeri 1 Adiwerna'
                ]),
                'cv' => 'public/storage/cv/magang_cv.pdf',
                'surat_izin' => 'public/storage/surat_izin/suratizin-dummy.pdf',
                'status' => $faker->randomElement(['menunggu', 'diproses', 'diterima', 'ditolak']),
                'tahun' => Carbon::parse($userData['created_at'])->year,
                'tanggal_batas_kedatangan' => Carbon::now()->addDays(rand(10, 60)),
                'created_at' => $userData['created_at'],
                'updated_at' => $userData['created_at'],
            ]);
        }
    }
}