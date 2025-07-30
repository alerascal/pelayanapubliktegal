<?php

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use Illuminate\Support\Facades\DB;
use App\Models\PendaftaranMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\MagangDiterimaMail;
use Illuminate\Support\Facades\Mail;
use App\Exports\PendaftarExport;
use App\Exports\LowonganExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserLog;
use App\Exports\MagangExport; // ✅ BENAR
use Illuminate\Support\Facades\Storage;

class LowonganMagangController extends Controller
{
    // === BACKEND ADMIN ===

    public function index(Request $request)
    {
        $currentYear = now()->year;
        $startYear = 2024;

        // Buat array tahun dari 2024 hingga sekarang
        $tahunList = range($startYear, $currentYear);
        rsort($tahunList); // biar tampil dari yang terbaru dulu (2025, 2024, dst)

        $tahunFilter = $request->tahun;

        $query = LowonganMagang::query();
        if ($tahunFilter) {
            $query->where('tahun', $tahunFilter);
        }

        $lowongan = $query->latest()->get();

        return view('pages.backend.magang.index', compact('lowongan', 'tahunList', 'tahunFilter'));
    }



    // Tampilkan form create (admin)
    public function create()
    {
        return view('pages.backend.magang.create');
    }

    // Simpan data lowongan baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'periode' => 'required|string',
            
        ]);
        $data = $request->all();
        $data['tahun'] = \Carbon\Carbon::parse($request->deadline)->year;
        LowonganMagang::create($data);
        UserLog::create([
    'user_id' => Auth::id(),
    'activity' => 'Menambahkan lowongan magang "' . $request->judul . '"',
    'activity_at' => now(),
]);


        return redirect()->route('magang.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    // Tampilkan form edit (admin)
    public function edit($id)
    {
        $lowongan = LowonganMagang::findOrFail($id);
        return view('pages.backend.magang.edit', compact('lowongan'));
    }

    // Update data lowongan (admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'periode' => 'required|string',
        ]);

        $lowongan = LowonganMagang::findOrFail($id);

        $data = $request->all();
        $data['tahun'] = \Carbon\Carbon::parse($request->deadline)->year;

        $lowongan->update($data);
        UserLog::create([
    'user_id' => Auth::id(),
    'activity' => 'Memperbarui lowongan magang "' . $request->judul . '"',
    'activity_at' => now(),
]);

        return redirect()->route('magang.index')->with('success', 'Lowongan berhasil diperbarui.');
    }


    // Hapus lowongan (admin)
    public function destroy($id)
    {
        $lowongan = LowonganMagang::findOrFail($id);
        $lowongan->delete();
        UserLog::create([
    'user_id' => Auth::id(),
    'activity' => 'Menghapus lowongan magang "' . $lowongan->judul . '"',
    'activity_at' => now(),
]);


        return redirect()->route('magang.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    // Tampilkan detail lowongan dan pendaftar (admin)
    public function show($id)
    {
        $lowongan = LowonganMagang::with('pendaftar')->findOrFail($id);
        return view('pages.backend.magang.show', compact('lowongan'));
    }
    public function hapusLowonganByTahun($tahun)
    {
        $lowongans = LowonganMagang::where('tahun', $tahun)->get();

        foreach ($lowongans as $lowongan) {
            // Hapus pendaftar juga (jika ada)
            $pendaftars = PendaftaranMagang::where('lowongan_id', $lowongan->id)->get();
            foreach ($pendaftars as $pendaftar) {
                Storage::delete($pendaftar->cv);
                Storage::delete($pendaftar->surat_izin);

                $pendaftar->delete();
            }

            $lowongan->delete();
        }

        return back()->with('success', "Semua lowongan & pendaftar tahun $tahun berhasil dihapus.");
    }
    public function pendaftar(Request $request)
    {
        $tahunFilter = $request->tahun;
        $search = $request->search;

        $lowongans = LowonganMagang::with(['pendaftar' => function ($query) use ($tahunFilter, $search) {
            if ($tahunFilter) {
                $query->whereYear('created_at', $tahunFilter);
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('lowongan_id', $search); // cari berdasarkan ID lowongan
                });
            }
        }])->orderBy('created_at', 'desc')->get();

        $tahunList = PendaftaranMagang::select(DB::raw('YEAR(created_at) as tahun'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderByDesc(DB::raw('YEAR(created_at)'))
            ->pluck('tahun');

        return view('pages.backend.magang.pendaftar', compact('lowongans', 'tahunList', 'tahunFilter', 'search'));
    }
    public function pendaftarByLowongan($id)
    {
        $lowongan = LowonganMagang::with('pendaftar')->findOrFail($id);
        return view('pages.backend.magang.pendaftar_detail', compact('lowongan'));
    }

  public function ubahStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:menunggu,diproses,diterima,ditolak',
    ]);

    $pendaftar = PendaftaranMagang::with('user', 'lowongan')->findOrFail($id);
    $pendaftar->status = $request->status;
    $pendaftar->save();

    // Kirim email hanya jika statusnya "diterima"
    if ($request->status === 'diterima') {
        Mail::to($pendaftar->email)->send(new MagangDiterimaMail($pendaftar));
    }
    UserLog::create([
    'user_id' => Auth::id(),
    'activity' => 'Mengubah status pendaftar "' . $pendaftar->nama . '" menjadi "' . $request->status . '"',
    'activity_at' => now(),
]);


    return back()->with('success', 'Status pendaftar berhasil diperbarui.');
}

    // Hapus pendaftar magang
    public function hapusPendaftar($id)
    {
        $pendaftar = PendaftaranMagang::findOrFail($id);

        // Hapus file jika perlu
        Storage::disk('public')->delete($pendaftar->cv);
        Storage::disk('public')->delete($pendaftar->surat_izin);

        $pendaftar->delete();
        UserLog::create([
    'user_id' => Auth::id(),
    'activity' => 'Menghapus pendaftar magang atas nama "' . $pendaftar->nama . '"',
    'activity_at' => now(),
]);


        return back()->with('success', 'Pendaftar berhasil dihapus.');
    }

    // === FRONTEND (USER) ===

    // Tampilkan daftar lowongan (publik)
    public function frontendIndex()
    {
        $lowongan = LowonganMagang::whereDate('deadline', '>=', now())->get();
        return view('lowonganmagang', compact('lowongan'));
    }

    // Tampilkan form pendaftaran magang
    public function showForm($id)
    {
        $lowongan = LowonganMagang::findOrFail($id);
        return view('pages.backend.magang.form', compact('lowongan'));
    }

    public function storePendaftaran(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'asal_sekolah' => 'nullable|string|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'surat_izin' => 'required|file|mimes:pdf,doc,docx|max:2048',

        ]);

        // Upload file
        $cvPath = $request->file('cv')->store('cv', 'public');
        $suratIzinPath = $request->file('surat_izin')->store('surat_izin', 'public');

      PendaftaranMagang::create([
    'lowongan_id' => $id,
    'user_id' => auth()->id(), // ⬅ tambahkan ini
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'email' => $request->email,
    'telepon' => $request->telepon,
    'asal_sekolah' => $request->asal_sekolah,
    'cv' => $cvPath,
    'surat_izin' => $suratIzinPath,
    'status' => 'menunggu',
]);

        // Redirect ke halaman pemberitahuan dengan session flash message
        return redirect()->route('pemberitahuan')->with('success', 'Pendaftaran berhasil dikirim.');
    }
   public function showPendaftar($id)
{
    $pendaftar = PendaftaranMagang::with('lowongan')->findOrFail($id);
    $lowongan = $pendaftar->lowongan;

    return view('pages.backend.magang.pendaftar_detail', compact('pendaftar', 'lowongan'));
}

    public function hapusSemuaPendaftar($id)
    {
        $lowongan = LowonganMagang::findOrFail($id);
        $pendaftarList = $lowongan->pendaftar;

        foreach ($pendaftarList as $pendaftar) {
            // Hapus file jika ada
            if ($pendaftar->cv) {
                Storage::disk('public')->delete($pendaftar->cv);
            }
            if ($pendaftar->surat_izin) {
                Storage::disk('public')->delete($pendaftar->surat_izin);
            }

            // Hapus data pendaftar
            $pendaftar->delete();
        }

        return back()->with('success', 'Semua pendaftar untuk lowongan ini berhasil dihapus.');
    }
    public function exportLowonganPdf($id)
    {
        $lowongan = LowonganMagang::with('pendaftar')->findOrFail($id);

        $pdf = Pdf::loadView('pages.backend.magang.export_lowongan_pdf', compact('lowongan'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('lowongan_' . str_replace(' ', '_', strtolower($lowongan->judul)) . '.pdf');
    }

    public function exportLowonganExcel($id)
    {
        $lowongan = LowonganMagang::with('pendaftar')->findOrFail($id);

        return Excel::download(new LowonganExport($lowongan), 'lowongan_' . str_replace(' ', '_', strtolower($lowongan->judul)) . '.xlsx');
    }

    public function exportPdf($id)
    {
        $pendaftar = PendaftaranMagang::findOrFail($id);
        $pdf = Pdf::loadView('pages.backend.magang.export_pdf', compact('pendaftar'));
        return $pdf->download('pendaftar_' . str_replace(' ', '_', strtolower($pendaftar->nama)) . '.pdf');
    }

    public function exportAllExcel()
    {
        return Excel::download(new PendaftarExport(), 'semua_pendaftar_magang.xlsx');
    }


    public function hapusExpired()
    {
        $expired = LowonganMagang::where('deadline', '<', now())->get();

        foreach ($expired as $item) {
            // Hapus semua pendaftar juga (jika ada relasi)
            $item->pendaftar()->delete();
            $item->delete();
        }

        return redirect()->back()->with('success', 'Semua lowongan yang telah expired berhasil dihapus.');
    }
    public function exportSemuaPdf()
{
    $pendaftar = PendaftaranMagang::with('lowongan')->get();

    $pdf = Pdf::loadView('pages.backend.magang.export_semua_pdf', compact('pendaftar'))
        ->setPaper('A4', 'landscape');

    return $pdf->download('semua_pendaftar_magang.pdf');
}
public function exportSemuaExcel()
{
    return Excel::download(new MagangExport, 'semua_pendaftar_magang.xlsx');
}

}
