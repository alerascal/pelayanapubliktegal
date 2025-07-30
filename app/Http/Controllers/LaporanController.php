<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftarExport;
use App\Exports\LaporanExport;
use App\Exports\AspirasiExport;
use App\Exports\AllCombinedExport;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        $tab = $request->get('tab', 'aspirasi'); // default tab
        $perPage = 10;

        $aspirasis = collect();
        $pendaftarans = collect();
        $lowongans = collect();
        $laporans = null;

        if ($tab === 'aspirasi') {
            $query = Aspirasi::with('user');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('isi', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q2) use ($search) {
                          $q2->where('name', 'like', "%{$search}%");
                      });
                });
            }

            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }

            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }
            /** @var \Illuminate\Pagination\LengthAwarePaginator $aspirasis */
            $aspirasis = $query->latest()->paginate($perPage)->withQueryString();

        } elseif ($tab === 'magang') {
            $query = PendaftaranMagang::with('lowongan');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('asal_sekolah', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%")
                      ->orWhereHas('lowongan', function ($q2) use ($search) {
                          $q2->where('judul', 'like', "%{$search}%");
                      });
                });
            }

            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }

            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }

            $pendaftarans = $query->latest()->paginate($perPage)->withQueryString();
            $lowongans = LowonganMagang::latest()->get();

        } elseif ($tab === 'laporan') {
            $aspirasiData = Aspirasi::with('user');
            $magangData = PendaftaranMagang::with('lowongan');

            if ($search) {
                $aspirasiData->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('isi', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q2) use ($search) {
                          $q2->where('name', 'like', "%{$search}%");
                      });
                });

                $magangData->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('asal_sekolah', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%")
                      ->orWhereHas('lowongan', function ($q2) use ($search) {
                          $q2->where('judul', 'like', "%{$search}%");
                      });
                });
            }

            if ($tahun) {
                $aspirasiData->whereYear('created_at', $tahun);
                $magangData->whereYear('created_at', $tahun);
            }

            if ($bulan) {
                $aspirasiData->whereMonth('created_at', $bulan);
                $magangData->whereMonth('created_at', $bulan);
            }
$aspirasiItems = $aspirasiData->get()->map(function ($item) {
    $item->setAttribute('tipe', 'aspirasi');
    return $item;
});

$magangItems = $magangData->get()->map(function ($item) {
    $item->setAttribute('tipe', 'magang');
    return $item;
});


            $gabungan = $aspirasiItems->concat($magangItems)->sortByDesc('created_at')->values();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = $gabungan->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $laporans = new LengthAwarePaginator(
                $currentItems,
                $gabungan->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('pages.backend.laporan.index', compact(
            'aspirasis',
            'pendaftarans',
            'lowongans',
            'laporans',
            'tab',
            'search',
            'tahun',
            'bulan'
        ));
    }
    public function previewAspirasi(Request $request)
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        $search = $request->get('search');

        $query = Aspirasi::with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $paginator = $query->latest()->paginate(10);

        $aspirasiByMonth = collect($paginator->items())->groupBy(function ($aspirasi) {
            return Carbon::parse($aspirasi->created_at)->translatedFormat('F Y');
        });

        return view('pages.backend.laporan.preview-aspirasi', compact('aspirasiByMonth', 'paginator', 'tahun', 'bulan', 'search'));
    }

    public function previewMagang(Request $request)
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        $search = $request->get('search');

        $query = PendaftaranMagang::with('lowongan');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhereHas('lowongan', function ($q2) use ($search) {
                      $q2->where('judul', 'like', "%{$search}%");
                  });
            });
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $paginator = $query->latest()->paginate(10);

        $pendaftarByMonth = collect($paginator->items())->groupBy(function ($pendaftaran) {
            return Carbon::parse($pendaftaran->created_at)->translatedFormat('F Y');
        });

        return view('pages.backend.laporan.preview-magang-all', compact('pendaftarByMonth', 'paginator', 'tahun', 'bulan', 'search'));
    }

    public function previewLaporan(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        $perPage = 10;

        $aspirasiData = Aspirasi::with('user');
        $magangData = PendaftaranMagang::with('lowongan');

        if ($search) {
            $aspirasiData->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });

            $magangData->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhereHas('lowongan', function ($q2) use ($search) {
                      $q2->where('judul', 'like', "%{$search}%");
                  });
            });
        }

        if ($tahun) {
            $aspirasiData->whereYear('created_at', $tahun);
            $magangData->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $aspirasiData->whereMonth('created_at', $bulan);
            $magangData->whereMonth('created_at', $bulan);
        }

     $aspirasiItems = $aspirasiData->get()->map(function ($item) {
    $item->setAttribute('tipe', 'aspirasi');
    return $item;
});

$magangItems = $magangData->get()->map(function ($item) {
    $item->setAttribute('tipe', 'magang');
    return $item;
});

        $gabungan = $aspirasiItems->concat($magangItems)->sortByDesc('created_at')->values();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $gabungan->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $currentItems,
            $gabungan->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $laporanByMonth = collect($paginator->items())->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->translatedFormat('F Y');
        });

        return view('pages.backend.laporan.preview-laporan', compact('laporanByMonth', 'paginator', 'tahun', 'bulan', 'search'));
    }

    public function exportAllAspirasiPdf(Request $request)
    {
        $search = $request->input('search');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        $query = Aspirasi::with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $aspirasis = $query->latest()->get();

        $pdf = Pdf::loadView('pages.backend.laporan.export_all_aspirasi_pdf', compact('aspirasis', 'tahun', 'bulan', 'search'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_aspirasi_' . now()->format('Ymd') . '.pdf');
    }

    public function exportAllPendaftarPdf(Request $request)
    {
        $search = $request->input('search');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        $query = PendaftaranMagang::with('lowongan');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhereHas('lowongan', function ($q2) use ($search) {
                      $q2->where('judul', 'like', "%{$search}%");
                  });
            });
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $pendaftarans = $query->latest()->get();

       $pdf = Pdf::loadView('pages.backend.laporan.export_all_magang_pdf', compact('pendaftarans', 'tahun', 'bulan', 'search'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_pendaftar_magang_' . now()->format('Ymd') . '.pdf');
    }

    public function exportAllCombinedPdf(Request $request)
    {
        $search = $request->input('search');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        $aspirasiQuery = Aspirasi::with('user');
        $magangQuery = PendaftaranMagang::with('lowongan');

        if ($search) {
            $aspirasiQuery->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });

            $magangQuery->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhereHas('lowongan', function ($q2) use ($search) {
                      $q2->where('judul', 'like', "%{$search}%");
                  });
            });
        }

        if ($tahun) {
            $aspirasiQuery->whereYear('created_at', $tahun);
            $magangQuery->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $aspirasiQuery->whereMonth('created_at', $bulan);
            $magangQuery->whereMonth('created_at', $bulan);
        }

        $aspirasis = $aspirasiQuery->latest()->get();
        $pendaftarans = $magangQuery->latest()->get();

        $pdf = Pdf::loadView('pages.backend.laporan.export_all_combined_pdf', compact('aspirasis', 'pendaftarans', 'tahun', 'bulan', 'search'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_aspirasi_dan_pendaftar_magang_' . now()->format('Ymd') . '.pdf');
    }

    public function exportPdf(Request $request)
    {
        $tab = $request->input('tab', 'aspirasi');
        $search = $request->input('search');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        if ($tab === 'aspirasi') {
            return $this->exportAllAspirasiPdf($request);
        } elseif ($tab === 'magang') {
            return $this->exportAllPendaftarPdf($request);
        } else {
            return $this->exportAllCombinedPdf($request);
        }
    }

    public function exportExcel(Request $request)
    {
        $tab = $request->input('tab', 'aspirasi');
        $search = $request->input('search');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        if ($tab === 'aspirasi') {
            return Excel::download(new AspirasiExport($search, $tahun, $bulan), 'aspirasi_' . now()->format('Ymd') . '.xlsx');
        } elseif ($tab === 'magang') {
            return Excel::download(new PendaftarExport($search, $tahun, $bulan), 'laporan_pendaftar_magang_' . now()->format('Ymd') . '.xlsx');
        } else {
            return Excel::download(new AllCombinedExport($search, $tahun, $bulan), 'laporan_aspirasi_dan_pendaftar_magang_' . now()->format('Ymd') . '.xlsx');
        }
    }

    public function exportLaporanPDF()
    {
      $laporans = collect()
    ->merge(Aspirasi::select('id', 'nama', 'created_at as tanggal_laporan')->get())
    ->merge(LowonganMagang::select('id', 'judul as nama', 'created_at as tanggal_laporan')->get())
    ->sortByDesc('tanggal_laporan');


        $pdf = Pdf::loadView('pages.backend.laporan.export_laporan_pdf', compact('laporans'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan_keseluruhan_' . now()->format('Ymd') . '.pdf');
    }

    public function exportLaporanExcel()
    {
        return Excel::download(new LaporanExport, 'laporan_keseluruhan_' . now()->format('Ymd') . '.xlsx');
    }
}