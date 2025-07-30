<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Berita;
use App\Models\AnggotaDewan;
use App\Models\Aspirasi;
use App\Models\UserLog;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Carbon\Carbon;

class DashboardController extends Controller
{
public function dashboard()
{
    // Data aspirasi & pendaftaran magang yang belum diproses
    $aspirasiBelumDiproses = Aspirasi::whereIn('status', ['menunggu', 'diproses'])->latest()->get();
    $pendaftarBelumDiproses = PendaftaranMagang::whereIn('status', ['menunggu', 'diproses'])->latest()->get();

    // Ambil semua lowongan magang dan user biasa
    $lowongans = LowonganMagang::all(); // ⬅️ Diletakkan di atas
    $firstLowongan = $lowongans->first();
    $users = User::where('role', 'user')->get();

    // Pendaftaran Magang per Lowongan
    $magangPerLowongan = PendaftaranMagang::selectRaw('lowongan_id, COUNT(*) as total')
        ->groupBy('lowongan_id')
        ->pluck('total', 'lowongan_id');

    // Ambil nama lowongan dari ID
    $lowonganLabels = [];
    $magangCounts = [];

    foreach ($lowongans as $lowongan) {
        $lowonganLabels[] = $lowongan->judul;
        $magangCounts[] = $magangPerLowongan[$lowongan->id] ?? 0;
    }

    // Grafik Aspirasi per Bulan
    $aspirasiPerBulan = Aspirasi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
        ->whereYear('created_at', now()->year)
        ->groupByRaw('MONTH(created_at)')
        ->orderByRaw('MONTH(created_at)')
        ->pluck('total', 'bulan');

    $bulanLabels = [];
    $aspirasiValues = [];

    for ($i = 1; $i <= 12; $i++) {
        $bulanLabels[] = Carbon::create()->month($i)->locale('id')->translatedFormat('F');
        $aspirasiValues[] = $aspirasiPerBulan[$i] ?? 0;
    }

    // Data umum
    $data = [
        'adminCount' => User::where('role', 'admin')->count(),
        'userCount' => User::where('role', 'user')->count(),
        'berita' => Berita::count(),
        'anggotaDewan' => AnggotaDewan::count(),
        'jumlahAspirasi' => Aspirasi::count(),
        'jumlahArsip' => Aspirasi::onlyTrashed()->count(),
        'aspirasiDiterima' => Aspirasi::where('status', 'diterima')->count(),
        'aspirasiDitolak' => Aspirasi::where('status', 'ditolak')->count(),
        'aspirasiBelumDiproses' => $aspirasiBelumDiproses,
        'pendaftarMagangDiterima' => PendaftaranMagang::where('status', 'diterima')->count(),
        'pendaftarMagangDitolak' => PendaftaranMagang::where('status', 'ditolak')->count(),
        'pendaftarBelumDiproses' => $pendaftarBelumDiproses,
        'adminLogs' => UserLog::whereHas('user', fn($q) => $q->where('role', 'admin'))->latest()->take(5)->get(),
        'jumlah_lowonganMagang' => $lowongans->count(),
        'jumlah_pendaftaranMagang' => PendaftaranMagang::count(),
        'lowongans' => $lowongans,
        'firstLowongan' => $firstLowongan,
        'users' => $users,
        'bulanLabels' => $bulanLabels,
        'aspirasiValues' => $aspirasiValues,
        'lowonganLabels' => $lowonganLabels,
        'magangCounts' => $magangCounts,
    ];

    // Kartu statistik (cards) dan return view bisa kamu lanjutkan seperti sebelumnya



        // Kartu dashboard (statistik)
       $cards = [
    ['count' => $data['adminCount'], 'title' => 'Total Admin', 'icon' => 'far fa-user', 'color' => 'bg-primary'],
    ['count' => $data['userCount'], 'title' => 'User Bukan Admin', 'icon' => 'fas fa-users', 'color' => 'bg-secondary'],
    ['count' => $data['berita'], 'title' => 'Berita', 'icon' => 'far fa-newspaper', 'color' => 'bg-danger'],
    ['count' => $data['anggotaDewan'], 'title' => 'Anggota Dewan', 'icon' => 'fas fa-users', 'color' => 'bg-warning'],
    ['count' => $data['jumlah_lowonganMagang'], 'title' => 'Lowongan Magang', 'icon' => 'fas fa-briefcase', 'color' => 'bg-info'],
    ['count' => $data['jumlah_pendaftaranMagang'], 'title' => 'Pendaftar Magang', 'icon' => 'fas fa-user-check', 'color' => 'bg-secondary'],

    // Dihapus:
    // ['count' => $data['pendaftarMagangDiterima'], ... ]
    // ['count' => $data['pendaftarMagangDitolak'], ... ]
    ['count' => $data['jumlahAspirasi'], 'title' => 'Aspirasi Masuk', 'icon' => 'fas fa-comments', 'color' => 'bg-info'],

    // Dihapus:
    // ['count' => $data['aspirasiDiterima'], ... ]
    // ['count' => $data['aspirasiDitolak'], ... ]
   ['count' => $data['jumlahArsip'], 'title' => 'Arsip Aspirasi', 'icon' => 'fas fa-archive', 'color' => 'bg-secondary'],
];

      UserLog::create([
    'user_id' => Auth::id(),
    'activity' => 'Mengakses dashboard',
    'activity_at' => now(),
]);

        // Kirim data ke view
        return view('pages.backend.dashboard', array_merge($data, [
            'cards' => $cards,
            'type_menu' => 'dashboard',
        ]));
    }
      public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,diterima,ditolak',
        ]);

        $pendaftar = PendaftaranMagang::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function userRegister()
    {
        $users = User::where('role', 'user')->get();
        return view('pages.backend.user-register', compact('users'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed',
        ]);

        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        /** @var \App\Models\User $user */
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}