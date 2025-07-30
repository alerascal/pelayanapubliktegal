<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat admin dan user.
     *
     * @return void
     */
    public function run()
    {
        // Seeder untuk Admin
        $admins = [
            [
                'name' => 'Admin DPRD Tegal 2',
                'email' => 'admin2@tegal.com',
                'nik' => '3201012000010002',
                'phone' => '081234567802',
                'alamat' => 'Jl. Merdeka No. 2',
            ],
            [
                'name' => 'Admin DPRD Tegal 3',
                'email' => 'admin3@tegal.com',
                'nik' => '3201012000010003',
                'phone' => '081234567803',
                'alamat' => 'Jl. Merdeka No. 3',
            ],
            [
                'name' => 'Admin DPRD Tegal 4',
                'email' => 'admin4@tegal.com',
                'nik' => '3201012000010004',
                'phone' => '081234567804',
                'alamat' => 'Jl. Merdeka No. 4',
            ],
            [
                'name' => 'Admin DPRD Tegal 5',
                'email' => 'admin5@tegal.com',
                'nik' => '3201012000010005',
                'phone' => '081234567805',
                'alamat' => 'Jl. Merdeka No. 5',
            ],
        ];

        foreach ($admins as $admin) {
            DB::table('users')->updateOrInsert(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'nik' => $admin['nik'],
                    'phone' => $admin['phone'],
                    'alamat' => $admin['alamat'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'), // password: 123
                    'remember_token' => Str::random(10),
                    'role' => 'admin',
                    'is_banned' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Seeder untuk User Biasa
        $users = [
            [
                'name' => 'User Biasa 1',
                'email' => 'user1@tegal.com',
                'nik' => '3201022000010001',
                'phone' => '081234567811',
                'alamat' => 'Jl. Ahmad Yani No. 1',
            ],
            [
                'name' => 'User Biasa 2',
                'email' => 'user2@tegal.com',
                'nik' => '3201022000010002',
                'phone' => '081234567812',
                'alamat' => 'Jl. Ahmad Yani No. 2',
            ],
            [
                'name' => 'User Biasa 3',
                'email' => 'user3@tegal.com',
                'nik' => '3201022000010003',
                'phone' => '081234567813',
                'alamat' => 'Jl. Ahmad Yani No. 3',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'nik' => $user['nik'],
                    'phone' => $user['phone'],
                    'alamat' => $user['alamat'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'), // password: 123
                    'remember_token' => Str::random(10),
                    'role' => 'user',
                    'is_banned' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
