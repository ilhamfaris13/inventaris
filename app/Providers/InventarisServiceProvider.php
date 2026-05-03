<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Models
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Maintenance;

// Observers
use App\Observers\BarangObserver;
use App\Observers\PeminjamanObserver;
use App\Observers\PengembalianObserver;
use App\Observers\MaintenanceObserver;

/**
 * InventarisServiceProvider
 *
 * CARA DAFTAR:
 * Tambahkan 'App\Providers\InventarisServiceProvider' ke dalam array
 * 'providers' di config/app.php  — ATAU —
 * di Laravel 10, tambahkan ke bootstrap/providers.php (jika pakai auto-discovery).
 *
 * Jika sudah ada AppServiceProvider dan tidak ingin file baru,
 * cukup pindahkan isi method boot() ke AppServiceProvider yang ada.
 */
class InventarisServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Daftarkan semua observer
        Barang::observe(BarangObserver::class);
        Peminjaman::observe(PeminjamanObserver::class);
        Pengembalian::observe(PengembalianObserver::class);
        Maintenance::observe(MaintenanceObserver::class);
    }
}
