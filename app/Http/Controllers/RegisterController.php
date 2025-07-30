<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('pages.auth.register'); // Pastikan file ini ada
    }
    protected function registered(Request $request, $user)
{
    \App\Models\UserLog::create([
        'user_id' => $user->id,
        'activity' => 'register',
        'activity_at' => now(),
    ]);
}


    /**
     * Proses registrasi pengguna baru.
     */
   public function register(Request $request)
{
    // Validasi data input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'nik' => 'required|string|max:16|unique:users,nik',
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Simpan ke database
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'nik' => $validated['nik'],
        'phone' => $validated['phone'],
        'password' => Hash::make($validated['password']),
    ]);

    // Login otomatis setelah registrasi
    auth()->login($user);


    // Kirim email verifikasi
    $user->sendEmailVerificationNotification();
    

    // Redirect ke halaman verifikasi
    return redirect()->route('verification.notice');
}

}
