<?php

namespace App\Observers;

use App\Models\Maintenance;
use App\Models\LogAktivitas;

/**
 * MaintenanceObserver
 * Daftarkan di AppServiceProvider::boot() dengan:
 *   Maintenance::observe(MaintenanceObserver::class);
 */
class MaintenanceObserver
{
    public function created(Maintenance $maintenance): void
    {
        // Update kondisi barang menjadi "diperbaiki" saat maintenance dibuat
        $maintenance->barang()->update(['kondisi' => 'diperbaiki']);

        LogAktivitas::catat(
            "Maintenance dimulai untuk barang ID #{$maintenance->barang_id}, teknisi ID #{$maintenance->teknisi_id}"
        );
    }

    public function updated(Maintenance $maintenance): void
    {
        // Ketika maintenance selesai, kembalikan kondisi barang menjadi "baik"
        if ($maintenance->isDirty('status') && $maintenance->status === 'selesai') {
            $maintenance->barang()->update(['kondisi' => 'baik']);

            LogAktivitas::catat(
                "Maintenance selesai untuk barang ID #{$maintenance->barang_id}"
            );
        }
    }
}
