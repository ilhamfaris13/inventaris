<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Maintenance;
use App\Models\StokTransaksi;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // ── Laporan Inventaris Barang ──────────────────────────────────────────

    public function inventaris(Request $request)
    {
        $barangs = Barang::with(['kategori', 'kepemilikan', 'ruangan'])
            ->search($request->q)
            ->kondisi($request->kondisi)
            ->byKategori($request->kategori_id)
            ->byRuangan($request->ruangan_id)
            ->orderBy('nama_barang')
            ->get();

        $ringkasan = [
            'total_item'      => $barangs->count(),
            'total_unit'      => $barangs->sum('jumlah'),
            'baik'            => $barangs->where('kondisi', 'baik')->sum('jumlah'),
            'rusak'           => $barangs->where('kondisi', 'rusak')->sum('jumlah'),
            'diperbaiki'      => $barangs->where('kondisi', 'diperbaiki')->sum('jumlah'),
        ];

        return view('laporan.inventaris', compact('barangs', 'ringkasan'));
    }

    // ── Laporan Peminjaman ────────────────────────────────────────────────

    public function peminjaman(Request $request)
    {
        $query = Peminjaman::with(['karyawan', 'barang', 'pengembalian'])
            ->periode($request->dari, $request->sampai);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->orderByDesc('tanggal_pinjam')->get();

        $ringkasan = [
            'total'         => $peminjamans->count(),
            'dipinjam'      => $peminjamans->where('status', 'dipinjam')->count(),
            'dikembalikan'  => $peminjamans->where('status', 'dikembalikan')->count(),
            'total_unit'    => $peminjamans->sum('jumlah'),
        ];

        return view('laporan.peminjaman', compact('peminjamans', 'ringkasan'));
    }

    // ── Laporan Maintenance ───────────────────────────────────────────────

    public function maintenance(Request $request)
    {
        $query = Maintenance::with(['barang', 'teknisi'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->dari,   fn($q) => $q->where('tanggal_perbaikan', '>=', $request->dari))
            ->when($request->sampai, fn($q) => $q->where('tanggal_perbaikan', '<=', $request->sampai));

        $maintenances = $query->orderByDesc('tanggal_perbaikan')->get();

        $ringkasan = [
            'total'      => $maintenances->count(),
            'diperbaiki' => $maintenances->where('status', 'diperbaiki')->count(),
            'selesai'    => $maintenances->where('status', 'selesai')->count(),
        ];

        return view('laporan.maintenance', compact('maintenances', 'ringkasan'));
    }

    // ── Laporan Stok Transaksi ────────────────────────────────────────────

    public function stok(Request $request)
    {
        $dari   = $request->dari   ?? now()->startOfMonth()->toDateString();
        $sampai = $request->sampai ?? now()->toDateString();

        $transaksis = StokTransaksi::with('barang')
            ->periode($dari, $sampai)
            ->when($request->tipe, fn($q) => $q->where('tipe', $request->tipe))
            ->orderByDesc('tanggal')
            ->get();

        $ringkasan = [
            'masuk'       => $transaksis->where('tipe', 'masuk')->sum('jumlah'),
            'keluar'      => $transaksis->where('tipe', 'keluar')->sum('jumlah'),
            'penyesuaian' => $transaksis->where('tipe', 'penyesuaian')->sum('jumlah'),
        ];

        return view('laporan.stok', compact('transaksis', 'ringkasan', 'dari', 'sampai'));
    }

    // ── Laporan Log Aktivitas ─────────────────────────────────────────────

    public function logAktivitas(Request $request)
    {
        $logs = LogAktivitas::with('karyawan')
            ->when($request->karyawan_id, fn($q) => $q->where('karyawan_id', $request->karyawan_id))
            ->when($request->dari,   fn($q) => $q->where('timestamp', '>=', $request->dari))
            ->when($request->sampai, fn($q) => $q->where('timestamp', '<=', $request->sampai . ' 23:59:59'))
            ->orderByDesc('timestamp')
            ->paginate(50)
            ->withQueryString();

        return view('laporan.log-aktivitas', compact('logs'));
    }
}
