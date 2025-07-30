<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SekretariatController extends Controller
{
    public function showSekretariat()
    {
        // Data yang akan ditampilkan dalam tabel
        $sections = [
            [
                'id' => 'sekretariat',
                'name' => 'Sekretariat DPRD dan Komisi-komisi',
                'description' => 'Mengelola administrasi kepegawaian, anggaran, dan mendukung kegiatan sidang DPRD.',
                'full_description' => 'Sekretariat DPRD dan komisi-komisi bertugas untuk mendukung administrasi kepegawaian, pengelolaan anggaran, dan kegiatan sidang DPRD serta pembuatan peraturan yang diperlukan.'
            ],
            [
                'id' => 'visi-misi',
                'name' => 'Visi dan Misi',
                'description' => 'Menjelaskan visi dan misi lembaga.',
                'full_description' => 'Visi dan misi lembaga DPRD mencakup tujuan jangka panjang serta arah yang ingin dicapai dalam meningkatkan kesejahteraan masyarakat dan pembangunan daerah.'
            ],
            [
                'id' => 'struktur',
                'name' => 'Struktur Organisasi',
                'description' => 'Menampilkan struktur organisasi DPRD.',
                'full_description' => 'Struktur organisasi DPRD terdiri dari ketua, wakil ketua, anggota, dan bagian sekretariat yang masing-masing memiliki tugas dan tanggung jawab dalam pengelolaan pemerintahan.'
            ],
            [
                'id' => 'dewan',
                'name' => 'Dewan Perwakilan Rakyat Daerah (DPRD)',
                'description' => 'Menjelaskan tugas dan fungsi DPRD.',
                'full_description' => 'Dewan Perwakilan Rakyat Daerah memiliki tugas untuk mewakili rakyat dalam pengambilan keputusan dan kebijakan publik di daerah.'
            ],
            [
                'id' => 'komisi',
                'name' => 'Komisi-komisi',
                'description' => 'Bidang pemerintahan, perekonomian, dan pembangunan.',
                'full_description' => 'Komisi-komisi DPRD dibagi dalam beberapa bidang seperti pemerintahan, perekonomian, dan pembangunan untuk mengawasi dan memberikan rekomendasi terkait kebijakan daerah.'
            ],
        ];

        return view('sekretariat.index', compact('sections'));
    }
}