<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Mail\AspirasiDiterimaMail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Exports\AspirasiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class AspirasiController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->keyword;

    // Ambil semua data sesuai filter
    $query = Aspirasi::with('user');

    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('isi', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('filter_judul')) {
        $query->where('judul', $request->filter_judul);
    }

    // Ambil semua aspirasi untuk digroup berdasarkan bulan
    $aspirasis = $query->latest()->get();

    // Group by bulan
    $grouped = $aspirasis->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('F Y');
    });

    // Tentukan bulan aktif berdasarkan halaman
    $currentPage = request()->get('page', 1);
    $groupedArray = $grouped->all();
    $keys = array_keys($groupedArray);
    $selectedKey = $keys[$currentPage - 1] ?? null;

    $paginatedData = $selectedKey ? [$selectedKey => $groupedArray[$selectedKey]] : [];

    // Buat paginator manual
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $paginatedData,
        count($groupedArray),
        1,
        $currentPage,
        ['path' => url()->current()]
    );

    return view('pages.backend.aspirasi.index', [
        'aspirasiByMonth' => $paginatedData,
        'paginator' => $paginator,
    ]);
}


  
    public function create()
    {
        return view('pages.backend.aspirasi.create');
    }

   public function store(Request $request)
{
    if (!Auth::check()) {
    return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk mengirim aspirasi.');
}

    $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'alamat' => 'required|string|max:255',
        'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    $filePath = null;
    if ($request->hasFile('lampiran')) {
        $filePath = $request->file('lampiran')->store('lampiran_aspirasi', 'public');
    }

    Aspirasi::create([
        'user_id' => Auth::id(),
        'judul' => $request->judul,
        'isi' => $request->isi,
        'alamat' => $request->alamat,
        'lampiran' => $filePath,
        'status' => 'menunggu',
    ]);

 return redirect()->route('pemberitahuan')->with('success', 'Aspirasi Anda berhasil dikirim.');
    }

    public function show($id)
    {
        $aspirasi = Aspirasi::withTrashed()->findOrFail($id);
        return view('pages.backend.aspirasi.show', compact('aspirasi'));
    }


public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:diproses,menunggu,diterima,ditolak,selesai,hangus'
    ]);

    $aspirasi = Aspirasi::findOrFail($id);
    $oldStatus = $aspirasi->status;
    $aspirasi->status = $request->status;
    $aspirasi->save();

    // Kirim email jika status diterima
    if ($request->status === 'diterima') {
        Mail::to($aspirasi->user->email)->send(new AspirasiDiterimaMail($aspirasi));
    }

    UserLog::create([
        'user_id' => Auth::id(),
        'activity' => 'Mengubah status aspirasi dari "' . $oldStatus . '" menjadi "' . $aspirasi->status . '"',
        'activity_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Status aspirasi berhasil diperbarui.');
}
    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $judul = $aspirasi->judul;
        $aspirasi->delete();

        UserLog::create([
            'User_id' => Auth::id(),
            'activity' => 'Mengarsipkan aspirasi "' . $judul . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diarsipkan.');
    }

 public function arsip(Request $request)
{
    $keyword = $request->keyword;

    $query = Aspirasi::onlyTrashed()->with('user');

    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('isi', 'like', "%{$keyword}%");
        });
    }

    // Ambil semua data yang dihapus dan groupBy per bulan
    $aspirasi = $query->orderBy('deleted_at', 'desc')->get();

    // Group berdasarkan bulan
    $grouped = $aspirasi->groupBy(function ($item) {
        return Carbon::parse($item->deleted_at)->locale('id')->translatedFormat('F Y');
    });

    // Ambil halaman saat ini
    $currentPage = request('page', 1);

    // Ambil hanya 1 bulan (1 grup) per halaman
    $groupedArray = $grouped->all();
    $keys = array_keys($groupedArray);
    $selectedKey = $keys[$currentPage - 1] ?? null;

    $paginatedData = $selectedKey ? [$selectedKey => $groupedArray[$selectedKey]] : [];

    // Kirim total halaman
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $paginatedData,
        count($groupedArray),
        1,
        $currentPage,
        ['path' => url()->current()]
    );

    return view('pages.backend.aspirasi.arsip', [
        'arsip' => $paginatedData,
        'paginator' => $paginator,
    ]);
}

    public function restore($id)
    {
        $aspirasi = Aspirasi::onlyTrashed()->findOrFail($id);
        $aspirasi->restore();

        UserLog::create([
            'User_id' => Auth::id(),
            'activity' => 'Mengembalikan aspirasi "' . $aspirasi->judul . '" dari arsip',
            'activity_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Aspirasi berhasil dikembalikan.');
    }

    public function restoreAll()
    {
        Aspirasi::onlyTrashed()->restore();

        UserLog::create([
            'User_id' => Auth::id(),
            'activity' => 'Mengembalikan semua aspirasi dari arsip',
            'activity_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Semua aspirasi berhasil dikembalikan.');
    }

    public function destroyAll()
    {
        Aspirasi::whereNull('deleted_at')->delete();

        UserLog::create([
            'User_id' => Auth::id(),
            'activity' => 'Mengarsipkan semua aspirasi',
            'activity_at' => now(),
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Semua aspirasi berhasil diarsipkan.');
    }

    public function deletePermanent($id)
    {
        $aspirasi = Aspirasi::onlyTrashed()->findOrFail($id);

        if ($aspirasi->lampiran) {
            Storage::disk('public')->delete($aspirasi->lampiran);
        }

        $judul = $aspirasi->judul;
        $aspirasi->forceDelete();

        UserLog::create([
            'User_id' => Auth::id(),
            'activity' => 'Menghapus permanen aspirasi "' . $judul . '"',
            'activity_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Aspirasi berhasil dihapus permanen.');
    }

    public function pemberitahuan()
    {
        $user_id = Auth::id();
        $aspirasis = Aspirasi::where('user_id', $user_id)->latest()->get();

        return view('pages.frontend.pemberitahuan', compact('aspirasis'));
    }
public function destroyAllPermanentArchived()
{
    // Ambil semua aspirasi yang sudah dihapus (soft deleted)
    $aspirasis = Aspirasi::onlyTrashed()->get();

    // Hapus file lampiran dari aspirasi yang diarsipkan
    foreach ($aspirasis as $aspirasi) {
        if ($aspirasi->lampiran) {
            Storage::disk('public')->delete($aspirasi->lampiran);
        }
    }

    // Hapus permanen semua aspirasi yang sudah diarsipkan
    Aspirasi::onlyTrashed()->forceDelete();

    UserLog::create([
        'user_id' => Auth::id(),
        'activity' => 'Menghapus semua aspirasi yang sudah diarsipkan secara permanen',
        'activity_at' => now(),
    ]);

    return redirect()->route('aspirasi.arsip')->with('success', 'Semua aspirasi arsip berhasil dihapus permanen.');
}


public function exportPDF()
{
    $aspirasis = Aspirasi::latest()->get();
    $pdf = Pdf::loadView('exports.aspirasi-modern', compact('aspirasis'));
    return $pdf->stream('laporan-aspirasi.pdf');
}


public function exportExcel()
{
    return Excel::download(new AspirasiExport, 'data_aspirasi.xlsx');
}
}
