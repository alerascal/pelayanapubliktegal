<?php

namespace App\Http\Controllers;

use App\Models\AnggotaDewan;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnggotaDewanController extends Controller
{
    public function index()
    {
        $anggotaDewan = AnggotaDewan::with('user')->latest()->paginate(10);
        return view('pages.backend.anggota_dewan.index', compact('anggotaDewan'))->with('type_menu', 'anggota');
    }

    public function create()
    {
        return view('pages.backend.anggota_dewan.create')->with('type_menu', 'anggota');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gambar_anggota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fraksi' => 'nullable|string|max:255',
             
        ]);

        $gambarPath = $request->hasFile('gambar_anggota')
            ? $request->file('gambar_anggota')->store('images/anggota', 'public')
            : 'images/default.png';

        $anggota = AnggotaDewan::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'gambar_anggota' => $gambarPath,
            'fraksi' => $validated['fraksi'] ?? null,
            'user_id' => auth()->id(),
              
        ]);

        // Log aktivitas admin
        UserLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Menambahkan anggota dewan bernama "' . $anggota->nama . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota dewan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = AnggotaDewan::findOrFail($id);
        return view('pages.backend.anggota_dewan.edit', compact('anggota'))->with('type_menu', 'anggota');
    }

    public function update(Request $request, AnggotaDewan $anggota)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gambar_anggota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fraksi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('gambar_anggota')) {
            if ($anggota->gambar_anggota && Storage::disk('public')->exists($anggota->gambar_anggota)) {
                Storage::disk('public')->delete($anggota->gambar_anggota);
            }

            $gambarPath = $request->file('gambar_anggota')->store('images/anggota', 'public');
            $anggota->gambar_anggota = $gambarPath;
        }

        $anggota->update([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'fraksi' => $validated['fraksi'] ?? null,
        ]);

        // Log aktivitas admin
        UserLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Mengedit anggota dewan bernama "' . $anggota->nama . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota dewan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = AnggotaDewan::find($id);

        if (!$anggota) {
            return redirect()->route('anggota.index')->with('error', 'Anggota dewan tidak ditemukan!');
        }

        if ($anggota->gambar_anggota && Storage::disk('public')->exists($anggota->gambar_anggota)) {
            Storage::disk('public')->delete($anggota->gambar_anggota);
        }

        $nama = $anggota->nama;
        $anggota->delete();

        // Log aktivitas admin
        UserLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Menghapus anggota dewan bernama "' . $nama . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota dewan berhasil dihapus!');
    }

    public function showAnggota()
    {
        $anggotaDewan = AnggotaDewan::all();
        return view('pages.frontend.anggota_dewan', compact('anggotaDewan'));
    }
}
