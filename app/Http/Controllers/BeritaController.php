<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('pages.backend.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('pages.backend.berita.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required|string',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $gambarPath = $request->file('gambar')->store('berita', 'public');

    $berita = Berita::create([
        'judul' => $request->judul,
        'slug' => Str::slug($request->judul), // Tambahkan slug
        'konten' => $request->konten,
        'gambar' => $gambarPath,
         'user_id' => Auth::id(),
    ]);

    Userlog::create([
        'user_id' => Auth::id(),
        'activity' => 'Menambahkan berita "' . $berita->judul . '"',
        'activity_at' => now(),
    ]);

    return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
}


    public function edit(Berita $berita)
    {
        return view('pages.backend.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

     $data = [
    'judul' => $request->judul,
    'slug' => Str::slug($request->judul),
    'konten' => $request->konten,
];

if ($request->hasFile('gambar')) {
    if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
        Storage::disk('public')->delete($berita->gambar);
    }
    $data['gambar'] = $request->file('gambar')->store('berita', 'public');
}

// Update data
$berita->update($data);



        // Log aktivitas u
        UserLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Mengubah berita "' . $berita->judul . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $judul = $berita->judul;
        $berita->delete();

        // Log aktivitas u
        UserLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Menghapus berita "' . $judul . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
