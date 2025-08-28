<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            if ($request->status === 'banned') {
                $query->where('is_banned', true);
            } elseif ($request->status === 'active') {
                $query->where('is_banned', false);
            }
        }

        $users = $query
    ->orderByRaw("FIELD(role, 'master', 'admin', 'user')")
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->appends($request->all());


        return view('admin.users.index', compact('users'));
    }

public function ban($id)
{
    $target = User::findOrFail($id);
    $current = Auth::user();

    if ($target->id === $current->id) {
        return back()->with('error', 'Anda tidak dapat membanned diri sendiri.');
    }

    // Admin hanya bisa ban user biasa
    if ($current->role === 'admin' && $target->role !== 'user') {
        return back()->with('error', 'Admin hanya dapat membanned user biasa.');
    }

    $target->is_banned = true;
    $target->save();

    UserLog::create([
        'user_id' => $current->id,
        'activity' => 'Membanned pengguna "' . $target->name . '"',
        'activity_at' => now(),
    ]);

    return back()->with('success', 'Pengguna berhasil dibanned.');
}

public function unban($id)
{
    $target = User::findOrFail($id);
    $current = Auth::user();

    if ($target->id === $current->id) {
        return back()->with('error', 'Anda tidak dapat mengubah status diri sendiri.');
    }

    if ($current->role === 'admin' && $target->role !== 'user') {
        return back()->with('error', 'Admin hanya dapat mengaktifkan kembali user biasa.');
    }

    $target->is_banned = false;
    $target->save();

    UserLog::create([
        'user_id' => $current->id,
        'activity' => 'Mengaktifkan kembali pengguna "' . $target->name . '"',
        'activity_at' => now(),
    ]);

    return back()->with('success', 'Pengguna berhasil diaktifkan kembali.');
}
public function changeRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|in:user,admin',
    ]);

    $target = User::findOrFail($id);
    $current = Auth::user();

    if ($target->id === $current->id) {
        return back()->with('error', 'Anda tidak dapat mengubah role diri sendiri.');
    }

    if ($target->role === 'master') {
        return back()->with('error', 'Role Master tidak dapat diubah.');
    }

    // Admin hanya bisa upgrade user → admin
    if ($current->role === 'admin') {
        if ($target->role !== 'user' || $request->role !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengubah role ini.');
        }
    }

    $target->role = $request->role;
    $target->save();

    UserLog::create([
        'user_id' => $current->id,
        'activity' => ucfirst($current->role) . ' mengubah role "' . $target->name . '" menjadi "' . $request->role . '"',
        'activity_at' => now(),
    ]);

    return back()->with('success', 'Role pengguna berhasil diperbarui.');
}


    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->intended('/dashboard');
        }

        return redirect()->intended('/');
    }
}
