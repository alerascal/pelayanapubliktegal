<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use App\Models\User;

class UserLogController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        $user_id = $request->input('user_id');

        // Ambil semua user dengan role 'admin' untuk dropdown filter
        $adminUsers = User::where('role', 'admin')->get();

        // Ambil log dari user admin saja
        $query = UserLog::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->orderBy('created_at', 'desc');

        // Filter by date if provided
        if ($date) {
            $query->whereDate('created_at', $date);
        }

        // Filter by user_id if provided
        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        $userLogs = $query->paginate(10);

        return view('admin.userlogs.index', compact('userLogs', 'adminUsers'));
    }
}