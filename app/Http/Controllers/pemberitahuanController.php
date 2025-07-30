<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;

class PemberitahuanController extends Controller
{
public function pemberitahuan()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login untuk melihat pemberitahuan.');
    }

    $user = Auth::user();

    // Pagination masing-masing
    $aspirasis = Aspirasi::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->paginate(3, ['*'], 'aspirasi_page'); // paginate 3 per halaman

    $pendaftarMagang = PendaftaranMagang::with('lowongan')
        ->where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->paginate(3, ['*'], 'magang_page'); // paginate 3 per halaman

    // Tetap bisa hitung total
    $jumlahAspirasi = $aspirasis->total();
    $jumlahMagang = $pendaftarMagang->total();

    return view('pages.frontend.pemberitahuan', compact('aspirasis', 'pendaftarMagang', 'jumlahAspirasi', 'jumlahMagang'));
}

public function indexFrontend()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login untuk melihat pemberitahuan.');
    }

    $user = Auth::user();

    // Ambil jumlah aspirasi & magang user
    $jumlahAspirasi = Aspirasi::where('user_id', $user->id)->count();
    $jumlahMagang = PendaftaranMagang::where('email', $user->email)->count();

    // Hanya tampilkan jika user memang pernah kirim aspirasi atau daftar magang
    if ($jumlahAspirasi === 0 && $jumlahMagang === 0) {
        return redirect()->route('home'); // Atau arahkan ke halaman lain
    }

    return view('pages.frontend.pemberitahuan', compact('jumlahAspirasi', 'jumlahMagang'));
}


}