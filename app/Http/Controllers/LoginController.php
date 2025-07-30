<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\UserLog;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect berdasarkan role
        if (Auth::check()) {
            return redirect($this->redirectBasedOnRole(Auth::user()));
        }

        return view('pages.auth.login');
    }

   public function login(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Coba login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Cek jika akun diblokir
        if ($user->is_banned) {
            // Tambahkan log aktivitas
            \App\Models\UserLog::create([
                'user_id' => $user->id,
                'activity' => 'Percobaan login oleh user yang diblokir',
                'activity_at' => now(),
            ]);

            Auth::logout();

            // Kirim notifikasi (opsional)
            return back()->withErrors([
                'email' => 'Akun Anda telah diblokir.',
            ])->with('status', 'Akun Anda telah diblokir oleh admin.')
              ->withInput($request->only('email'));
        }

        // Tambahkan log aktivitas jika login sukses
        \App\Models\UserLog::create([
            'user_id' => $user->id,
            'activity' => 'Login ke sistem',
            'activity_at' => now(),
        ]);

        // Redirect sesuai role
        return redirect($this->redirectBasedOnRole($user));
    }

    // Gagal login
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput($request->only('email'));
}


    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Redirect berdasarkan role.
     */
    protected function redirectBasedOnRole($user)
    {
        return $user->isAdmin() ? '/dashboard' : '/';
    }
}
