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
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            if ($request->status == 'banned') {
                $query->where('is_banned', true);
            } elseif ($request->status == 'active') {
                $query->where('is_banned', false);
            }
        }

        $users = $query->paginate(10)->appends($request->all());

        return view('admin.users.index', compact('users'));
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = true;
        $user->save();

        UserLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Membanned pengguna "' . $user->name . '"',
            'activity_at' => now(),
        ]);

        return back()->with('success', 'Pengguna berhasil dibanned.');
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = false;
        $user->save();

        UserLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Mengaktifkan kembali pengguna "' . $user->name . '"',
            'activity_at' => now(),
        ]);

        return back()->with('success', 'Pengguna berhasil diaktifkan kembali.');
    }

    public function changeRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        UserLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Mengubah role pengguna "' . $user->name . '" menjadi "' . $user->role . '"',
            'activity_at' => now(),
        ]);

        return back()->with('success', 'Role pengguna diperbarui.');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->intended('/dashboard');
        }

        return redirect()->intended('/');
    }
}
