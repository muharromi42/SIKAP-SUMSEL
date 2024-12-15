<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();

            // Pastikan user sudah login
            if ($user) {
                // Cek apakah user sudah mengunggah berkas
                $hasUploaded = \App\Models\BerkasModel::where('user_id', $user->id)->exists();

                // Ambil deadline user
                $deadline = $user->deadline ? Carbon::parse($user->deadline) : null;

                // Logika notifikasi
                $notification = null;
                if (!$hasUploaded && $deadline && now()->diffInDays($deadline, false) <= 7) {
                    $notification = "Anda belum mengunggah berkas apa pun. Deadline: {$deadline->format('d-m-Y')}. Segera unggah berkas Anda!";
                }

                // Bagikan notifikasi ke semua view
                $view->with('notification', $notification);
            }
        });
    }
}
