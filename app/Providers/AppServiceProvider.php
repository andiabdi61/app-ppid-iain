<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\InformasiPublikCategory;
use App\Observers\InformasiPublikCategoryObserver;
use App\Models\DokumenCategory;
use App\Observers\DokumenCategoryObserver;
use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator; // ← DITAMBAHKAN

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
        // Default string length untuk MySQL <= 5.7
        Schema::defaultStringLength(191);

        // --- Memaksa HTTPS untuk Lingkungan Produksi ---
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // --- Memaksa Timezone Aplikasi ---
        Carbon::setLocale('id');
        config(['app.timezone' => 'Asia/Jakarta']);
        date_default_timezone_set('Asia/Jakarta');

        // --- Pagination Tailwind --- // ← DITAMBAHKAN
        Paginator::defaultView('pagination.tailwind'); // ← DITAMBAHKAN

        // --- KODE UNTUK MEMBAGI PENGATURAN UMUM WEB ---
        try {
            $settings = Setting::pluck('value', 'key');
            View::share('settings', $settings);
        } catch (\Exception $e) {
            View::share('settings', collect());
        }

        InformasiPublikCategory::observe(InformasiPublikCategoryObserver::class);
        DokumenCategory::observe(DokumenCategoryObserver::class);
        Category::observe(CategoryObserver::class);
    }
}