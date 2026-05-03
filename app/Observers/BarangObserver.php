<?php

namespace App\Observers;

use App\Models\Barang;
use App\Models\LogAktivitas;

/**
 * BarangObserver
 * Daftarkan di App\Providers\AppServiceProvider::boot() dengan:
 *   Barang::observe(BarangObserver::class);
 */
class BarangObserver
{
    public function created(Barang $barang): void
    {
        LogAktivitas::catat(
            "Menambah barang baru: [{$barang->kode_barang}] {$barang->nama_barang} (Jumlah: {$barang->jumlah})"
        );
    }

    public function updated(Barang $barang): void
    {
        $perubahan = [];

        if ($barang->isDirty('kondisi')) {
            $perubahan[] = "kondisi: {$barang->getOriginal('kondisi')} → {$barang->kondisi}";
        }
        if ($barang->isDirty('jumlah')) {
            $perubahan[] = "jumlah: {$barang->getOriginal('jumlah')} → {$barang->jumlah}";
        }
        if ($barang->isDirty('lokasi')) {
            $perubahan[] = "lokasi: {$barang->getOriginal('lokasi')} → {$barang->lokasi}";
        }
        if ($barang->isDirty('ruangan_id')) {
            $perubahan[] = "ruangan diperbarui";
        }

        $detail = count($perubahan) > 0 ? ' (' . implode(', ', $perubahan) . ')' : '';

        LogAktivitas::catat(
            "Mengubah barang: [{$barang->kode_barang}] {$barang->nama_barang}{$detail}"
        );
    }

    public function deleted(Barang $barang): void
    {
        LogAktivitas::catat(
            "Menghapus barang: [{$barang->kode_barang}] {$barang->nama_barang}"
        );
    }

    public function restored(Barang $barang): void
    {
        LogAktivitas::catat(
            "Memulihkan barang: [{$barang->kode_barang}] {$barang->nama_barang}"
        );
    }
}
