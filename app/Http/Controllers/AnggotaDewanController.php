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
            'fraksi' => 'nullable|string|max:255',
            'gambar_anggota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kontak' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|array',
            'pendidikan.*' => 'nullable|string|max:255',
            'pengalaman' => 'nullable|array',
            'pengalaman.*' => 'nullable|string|max:1000',
            'sosmed' => 'nullable|array',
            'sosmed.*' => 'nullable|url',
            'bio_latar' => 'nullable|string',
            'bio_karier' => 'nullable|string',
            'bio_jabatan' => 'nullable|string',
            'bio_visi' => 'nullable|string',
            'bio_fokus' => 'nullable|string',
        ]);

        $pendidikan = array_filter($request->pendidikan ?? [], fn($item) => !empty(trim($item)));
        $pengalaman = array_filter($request->pengalaman ?? [], fn($item) => !empty(trim($item)));

        $gambarPath = $request->hasFile('gambar_anggota')
            ? $request->file('gambar_anggota')->store('images/anggota', 'public')
            : 'images/default.png';

        $anggota = AnggotaDewan::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'fraksi' => $validated['fraksi'] ?? null,
            'gambar_anggota' => $gambarPath,
            'kontak' => $request->kontak,
            'pendidikan' => !empty($pendidikan) ? json_encode($pendidikan) : null,
            'pengalaman' => !empty($pengalaman) ? json_encode($pengalaman) : null,
            'sosmed' => $request->sosmed ? json_encode($request->sosmed) : null,
            'bio_latar' => $request->bio_latar,
            'bio_karier' => $request->bio_karier,
            'bio_jabatan' => $request->bio_jabatan,
            'bio_visi' => $request->bio_visi,
            'bio_fokus' => $request->bio_fokus,
            'user_id' => auth()->id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
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
            'nama' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'fraksi' => 'nullable|string|max:255',
            'gambar_anggota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kontak' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|array',
            'pendidikan.*' => 'nullable|string|max:255',
            'pengalaman' => 'nullable|array',
            'pengalaman.*' => 'nullable|string|max:1000',
            'sosmed' => 'nullable|array',
            'sosmed.*' => 'nullable|url',
            'bio_latar' => 'nullable|string',
            'bio_karier' => 'nullable|string',
            'bio_jabatan' => 'nullable|string',
            'bio_visi' => 'nullable|string',
            'bio_fokus' => 'nullable|string',
        ]);

        $pendidikan = array_filter($request->pendidikan ?? [], fn($item) => !empty(trim($item)));
        $pengalaman = array_filter($request->pengalaman ?? [], fn($item) => !empty(trim($item)));

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'fraksi' => $request->fraksi,
            'kontak' => $request->kontak,
            'pendidikan' => !empty($pendidikan) ? json_encode($pendidikan) : null,
            'pengalaman' => !empty($pengalaman) ? json_encode($pengalaman) : null,
            'sosmed' => $request->sosmed ? json_encode($request->sosmed) : null,
            'bio_latar' => $request->bio_latar,
            'bio_karier' => $request->bio_karier,
            'bio_jabatan' => $request->bio_jabatan,
            'bio_visi' => $request->bio_visi,
            'bio_fokus' => $request->bio_fokus,
        ];

        // Ganti foto jika diupload
        if ($request->hasFile('gambar_anggota')) {
            if ($anggota->gambar_anggota && Storage::disk('public')->exists($anggota->gambar_anggota) && $anggota->gambar_anggota !== 'images/default.png') {
                Storage::disk('public')->delete($anggota->gambar_anggota);
            }

            $data['gambar_anggota'] = $request->file('gambar_anggota')->store('images/anggota', 'public');
        }

        $anggota->update($data);

        UserLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Mengedit anggota dewan bernama "' . ($data['nama'] ?? $anggota->nama) . '"',
            'activity_at' => now(),
        ]);

        return redirect()->route('anggota.show', $anggota->id)->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function show($id)
    {
        $anggota = AnggotaDewan::with('user')->findOrFail($id);
        $anggota->refresh(); // tambahkan ini

        return view('pages.backend.anggota_dewan.show', compact('anggota'))->with('type_menu', 'anggota');
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

        UserLog::create([
            'user_id' => auth()->id(),
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
