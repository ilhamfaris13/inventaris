<?php

namespace App\Observers;

use App\Models\Pengembalian;
use App\Models\LogAktivitas;

/**
 * PengembalianObserver
 * Daftarkan di AppServiceProvider::boot() dengan:
 *   Pengembalian::observe(PengembalianObserver::class);
 */
class PengembalianObserver
{
    public function created(Pengembalian $pengembalian): void
    {
        $peminjaman = $pengembalian->peminjaman;

        // Tandai peminjaman sebagai dikembalikan
        $peminjaman->update(['status' => 'dikembalikan']);

        // Jika barang dikembalikan dalam kondisi rusak → update kondisi barang
        if (in_array($pengembalian->kondisi_barang, ['rusak', 'hilang'])) {
            $peminjaman->barang()->update([
                'kondisi' => $pengembalian->kondisi_barang === 'rusak' ? 'rusak' : 'rusak',
            ]);
        }

        LogAktivitas::catat(
            "Pengembalian barang dari peminjaman ID #{$peminjaman->id}, kondisi: {$pengembalian->kondisi_barang}"
        );
    }
}
