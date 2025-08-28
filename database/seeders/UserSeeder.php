<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Master Admin (is_master = true)
        User::updateOrCreate(
            ['email' => 'master@tegal.com'],
            [
                'name' => 'Master Admin DPRD Tegal',
                'nik' => '3201011999010001',
                'phone' => '081234567801',
                'alamat' => 'Jl. Proklamasi No. 1',
                'email_verified_at' => now(),
                'password' => Hash::make('123'), // Password: 123
                'remember_token' => Str::random(10),
                'role' => 'master',
                'is_master' => true,
                'is_banned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Admin Biasa
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
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'nik' => $admin['nik'],
                    'phone' => $admin['phone'],
                    'alamat' => $admin['alamat'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'), // Password: 123
                    'remember_token' => Str::random(10),
                    'role' => 'admin',
                    'is_master' => false,
                    'is_banned' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // User Biasa
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
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'nik' => $user['nik'],
                    'phone' => $user['phone'],
                    'alamat' => $user['alamat'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('123'), // Password: 123
                    'remember_token' => Str::random(10),
                    'role' => 'user',
                    'is_master' => false,
                    'is_banned' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
