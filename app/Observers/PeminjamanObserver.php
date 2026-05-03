<?php

namespace App\Observers;

use App\Models\Peminjaman;
use App\Models\StokTransaksi;
use App\Models\LogAktivitas;

/**
 * PeminjamanObserver
 * Daftarkan di AppServiceProvider::boot() dengan:
 *   Peminjaman::observe(PeminjamanObserver::class);
 */
class PeminjamanObserver
{
    public function created(Peminjaman $peminjaman): void
    {
        // Catat transaksi stok keluar
        StokTransaksi::create([
            'barang_id'  => $peminjaman->barang_id,
            'tipe'       => 'keluar',
            'jumlah'     => $peminjaman->jumlah,
            'tanggal'    => $peminjaman->tanggal_pinjam,
            'keterangan' => "Dipinjam oleh karyawan ID #{$peminjaman->karyawan_id}",
        ]);

        LogAktivitas::catat(
            "Peminjaman barang ID #{$peminjaman->barang_id} sebanyak {$peminjaman->jumlah} unit oleh karyawan ID #{$peminjaman->karyawan_id}"
        );
    }

    public function updated(Peminjaman $peminjaman): void
    {
        // Ketika status berubah menjadi dikembalikan
        if ($peminjaman->isDirty('status') && $peminjaman->status === 'dikembalikan') {
            StokTransaksi::create([
                'barang_id'  => $peminjaman->barang_id,
                'tipe'       => 'masuk',
                'jumlah'     => $peminjaman->jumlah,
                'tanggal'    => now()->toDateString(),
                'keterangan' => "Dikembalikan dari peminjaman ID #{$peminjaman->id}",
            ]);

            LogAktivitas::catat(
                "Pengembalian barang ID #{$peminjaman->barang_id} sebanyak {$peminjaman->jumlah} unit dari peminjaman ID #{$peminjaman->id}"
            );
        }
    }
}
