<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AnggotaDewanController;
use App\Http\Controllers\PemberitahuanController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\LowonganMagangController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\LaporanController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;

// -------------------------
// Guest routes (Unauthenticated)
// -------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// -------------------------
// Email verification
// -------------------------
Route::get('/email/verify', fn() => view('pages.auth.emails.verify'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



// -------------------------
// Logout
// -------------------------
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// -------------------------
// Public Pages
// -------------------------
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/post/{slug}', [FrontendController::class, 'postDetail'])->name('post.detail');
Route::view('/sejarah', 'pages.frontend.sejarah')->name('sejarah');
Route::view('/visimisi', 'pages.frontend.visimisi')->name('visimisi');
Route::get('/sekretariat', [FrontendController::class, 'sekretariat'])->name('sekretariat');
Route::get('/lowongan-magang', [LowonganMagangController::class, 'frontendIndex'])->name('magang.lowongan');
Route::get('/anggota-dewan', [AnggotaDewanController::class, 'showAnggota'])->name('anggota.showAnggota');
Route::get('/anggota/{id}/detail', [FrontendController::class, 'detailAnggota'])->name('anggota.detail');

// -------------------------
// Authenticated (All users)
// -------------------------
Route::middleware('auth')->group(function () {
    Route::put('/profile/update', [DashboardController::class, 'update'])->name('profile.update');

    Route::get('/magang/daftar/{id}', [LowonganMagangController::class, 'showForm'])->name('magang.form');
    Route::post('/magang/daftar/{id}', [LowonganMagangController::class, 'storePendaftaran'])->name('magang.daftar.store');

    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi/store', [AspirasiController::class, 'store'])->name('aspirasi.store');

    Route::get('/pemberitahuan', [PemberitahuanController::class, 'pemberitahuan'])->name('pemberitahuan');
});

// -------------------------
// Admin-Only Routes
// -------------------------
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Grouped under /backend prefix
    Route::prefix('backend')->group(function () {
        // Berita
        Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);

        Route::resource('anggota', AnggotaDewanController::class)->parameters([
            'anggota' => 'anggota'
        ]);


        // Aspirasi (admin)
        Route::prefix('aspirasi')->group(function () {
            Route::get('/', [AspirasiController::class, 'index'])->name('aspirasi.index');
            Route::get('/arsip', [AspirasiController::class, 'arsip'])->name('aspirasi.arsip');
            Route::get('/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
            Route::patch('/{id}/update-status', [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
            Route::delete('/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
            Route::post('/restore/{id}', [AspirasiController::class, 'restore'])->name('aspirasi.restore');
            Route::post('/restore-all', [AspirasiController::class, 'restoreAll'])->name('aspirasi.restoreAll');
            Route::post('/hapus-semua', [AspirasiController::class, 'destroyAll'])->name('aspirasi.destroyAll');
            Route::delete('/delete-permanent/{id}', [AspirasiController::class, 'deletePermanent'])->name('aspirasi.deletePermanent');
            Route::post('/destroy-archived-permanent', [AspirasiController::class, 'destroyAllPermanentArchived'])->name('aspirasi.destroyAllPermanentArchived');
            Route::post('/export-pdf', [AspirasiController::class, 'exportPdf'])->name('aspirasi.export.pdf');
            Route::post('/export-excel', [AspirasiController::class, 'exportExcel'])->name('aspirasi.export.excel');
            Route::get('/preview', [LaporanController::class, 'previewAspirasi'])->name('aspirasi.preview');
        });

        // Magang
        Route::prefix('magang')->group(function () {
            Route::get('/', [LowonganMagangController::class, 'index'])->name('magang.index');
            Route::get('/create', [LowonganMagangController::class, 'create'])->name('magang.create');
            Route::post('/store', [LowonganMagangController::class, 'store'])->name('magang.store');
            Route::get('/edit/{id}', [LowonganMagangController::class, 'edit'])->name('magang.edit');
            Route::put('/update/{id}', [LowonganMagangController::class, 'update'])->name('magang.update');
            Route::delete('/delete/{id}', [LowonganMagangController::class, 'destroy'])->name('magang.destroy');
            Route::get('/show/{id}', [LowonganMagangController::class, 'show'])->name('magang.show');
            Route::delete('/hapus-tahun/{tahun}', [LowonganMagangController::class, 'hapusLowonganByTahun'])->name('magang.hapusTahun');
            Route::get('/pendaftar', [LowonganMagangController::class, 'pendaftar'])->name('magang.pendaftar');
            Route::delete('/hapus-expired', [LowonganMagangController::class, 'hapusExpired'])->name('magang.hapusExpired');
            Route::post('/export-lowongan-pdf/{id}', [LowonganMagangController::class, 'exportLowonganPdf'])->name('magang.export.lowongan.pdf');
            Route::post('/export-lowongan-excel/{id}', [LowonganMagangController::class, 'exportLowonganExcel'])->name('magang.export.lowongan.excel');
            Route::post('/export-pdf/pendaftar/{id}', [LowonganMagangController::class, 'exportPdf'])->name('magang.export.pdf');
            Route::get('/pendaftar/{id}', [LowonganMagangController::class, 'showPendaftar'])->name('pendaftar.detail');
            Route::post('/export-excel/lowongan/{id}', [LowonganMagangController::class, 'exportExcel'])->name('magang.export.excel');
            Route::get('/pendaftar/detail/{id}', [LowonganMagangController::class, 'pendaftarByLowongan'])->name('magang.pendaftar.detail');
            Route::patch('/pendaftar/status/{id}', [LowonganMagangController::class, 'ubahStatus'])->name('magang.status');
            Route::delete('/pendaftar/{id}', [LowonganMagangController::class, 'hapusPendaftar'])->name('pendaftar.hapus');
            Route::post('/export-semua-pdf', [LowonganMagangController::class, 'exportSemuaPdf'])->name('magang.export.all.pdf');
            Route::post('/export-semua-excel', [LowonganMagangController::class, 'exportSemuaExcel'])->name('magang.export.all.excel');
            Route::delete('/{id}/hapus-semua', [LowonganMagangController::class, 'hapusSemuaPendaftar'])->name('pendaftar.hapus.semua');
        });

        // Laporan
        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
            Route::post('/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
            Route::post('/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
            Route::get('/preview-aspirasi', [LaporanController::class, 'previewAspirasi'])->name('laporan.preview-aspirasi');
            Route::get('/preview-magang', [LaporanController::class, 'previewMagang'])->name('laporan.preview-magang');
            Route::get('/preview-laporan', [LaporanController::class, 'previewLaporan'])->name('laporan.preview-laporan');
            Route::post('/export-laporan-pdf', [LaporanController::class, 'exportLaporanPDF'])->name('laporan.export-laporan-pdf');
            Route::post('/export-laporan-excel', [LaporanController::class, 'exportLaporanExcel'])->name('laporan.export-laporan-excel');
        });

        // Admin User Management
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::post('/users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
            Route::post('/users/{id}/unban', [UserController::class, 'unban'])->name('users.unban');
            Route::post('/users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.changeRole');

            // User logs
            Route::get('/userlogs', [UserLogController::class, 'index'])->name('userlogs.index');
        });
    });
});
