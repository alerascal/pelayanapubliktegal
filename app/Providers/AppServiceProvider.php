<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap(); // Untuk styling pagination

        // Kirim data log aktivitas ke semua view
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                // 5 aktivitas terbaru
                $logs = UserLog::where('user_id', $userId)
                    ->latest()
                    ->take(5)
                    ->get();

                // Hitung jumlah aktivitas hari ini
                $todayCount = UserLog::where('user_id', $userId)
                    ->whereDate('activity_at', now()->toDateString())
                    ->count();

                $view->with('headerLogs', $logs)
                     ->with('headerLogCount', $todayCount);
            }
        });
    }
}
