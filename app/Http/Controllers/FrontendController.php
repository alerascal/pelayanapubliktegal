<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use App\Models\AnggotaDewan;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $berita = Berita::inRandomOrder()->paginate(6); 
        $anggotaDewan = AnggotaDewan::all();
        $lowonganMagang = LowonganMagang::latest()->take(3)->get(); 
        $firstLowongan = LowonganMagang::latest()->first();
        $jumlahAspirasi = 0;
        $jumlahMagang = 0;

        if (Auth::check()) {
            $user = Auth::user();
            $jumlahAspirasi = Aspirasi::where('user_id', $user->id)->count();
            $jumlahMagang = PendaftaranMagang::where('user_id', $user->id)->count();
        }

        return view('pages.frontend.home', compact(
            'berita', 
            'anggotaDewan', 
            'lowonganMagang', 
            'jumlahAspirasi', 
            'jumlahMagang',
            'firstLowongan'
        ));
    }

    public function sekretariat()
    {
        return view('pages.frontend.sekretariat');
    }

    public function postDetail($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $previousBerita = Berita::where('id', '<', $berita->id)->orderBy('id', 'desc')->first();
        $nextBerita = Berita::where('id', '>', $berita->id)->orderBy('id', 'asc')->first();
        $beritaLain = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        return view('pages.frontend.post_detail', compact(
            'berita', 'previousBerita', 'nextBerita', 'beritaLain'
        ));
    }

    public function detailAnggota($id)
    {
        $anggota = AnggotaDewan::findOrFail($id);
        return view('pages.frontend.detail_anggota', compact('anggota'));
    }
}