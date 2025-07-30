<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel berita
        Berita::truncate(); // hapus semua data berita

        $this->command->warn('Semua data berita telah dihapus.');

        // Ambil beberapa user sebagai penulis
        $users = User::take(3)->get();

        if ($users->isEmpty()) {
            $this->command->warn('Tidak ada user ditemukan. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        // Pastikan gambar berita-dumy.jpg tersedia di storage
        $source = public_path('storage/berita/berita-dummy.jpg');
        $target = 'berita/berita-dummy.jpg';

        if (!Storage::disk('public')->exists($target)) {
            if (file_exists($source)) {
                Storage::disk('public')->put($target, file_get_contents($source));
                $this->command->info('Gambar berita-dummy.jpg berhasil disalin ke storage.');
            } else {
                $this->command->error('File berita-dummy.jpg tidak ditemukan di public/storage/berita.');
                return;
            }
        }

        // Buat 30 data berita dengan penulis acak dari 3 user
        for ($i = 1; $i <= 30; $i++) {
            $user = $users->random(); // pilih salah satu user secara acak
            $judul = 'Berita ke-' . $i . ' oleh ' . $user->name;

            Berita::create([
                'slug' => Str::slug($judul . '-' . Str::random(5)),
                'judul' => $judul,
                'gambar' => 'berita/berita-dummy.jpg',
                'konten' => fake()->paragraphs(5, true),
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Seeder Berita berhasil membuat 30 data.');
    }
}
