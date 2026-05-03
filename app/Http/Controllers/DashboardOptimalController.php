<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Maintenance;
use App\Models\JadwalMaintenance;
use App\Models\LogAktivitas;
use App\Models\StokTransaksi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * DashboardOptimalController
 * Route: GET /dashboard-optimal  → tambahkan ke routes/web.php
 * View : resources/views/dashboard/optimal.blade.php
 */
class DashboardOptimalController extends Controller
{
    public function index()
    {
        // ── Ringkasan kondisi barang ─────────────────────────────────────────
        $ringkasanKondisi = Barang::select('kondisi', DB::raw('COUNT(*) as total_item'), DB::raw('SUM(jumlah) as total_unit'))
            ->groupBy('kondisi')
            ->get()
            ->keyBy('kondisi');

        $totalBarang      = Barang::count();
        $totalUnit        = Barang::sum('jumlah');
        $barangBaik       = $ringkasanKondisi->get('baik')?->total_unit ?? 0;
        $barangRusak      = $ringkasanKondisi->get('rusak')?->total_unit ?? 0;
        $barangDiperbaiki = $ringkasanKondisi->get('diperbaiki')?->total_unit ?? 0;

        // ── Peminjaman aktif ─────────────────────────────────────────────────
        $peminjamanAktif = Peminjaman::with(['karyawan', 'barang'])
            ->aktif()
            ->orderByDesc('tanggal_pinjam')
            ->limit(10)
            ->get();

        $totalDipinjam = Peminjaman::aktif()->count();

        // ── Peminjaman terlambat ─────────────────────────────────────────────
        $peminjamanTerlambat = Peminjaman::with(['karyawan', 'barang'])
            ->terlambat()
            ->count();

        // ── Maintenance berlangsung ──────────────────────────────────────────
        $maintenanceBerlangsung = Maintenance::with(['barang', 'teknisi'])
            ->berlangsung()
            ->get();

        // ── Jadwal maintenance akan datang (7 hari) ──────────────────────────
        $jadwalAkanDatang = JadwalMaintenance::with(['barang', 'teknisi'])
            ->akanDatang(7)
            ->orderBy('jadwal_tanggal')
            ->get();

        $jadwalTerlambat = JadwalMaintenance::terlambat()->count();

        // ── Log aktivitas terbaru ────────────────────────────────────────────
        $logTerbaru = LogAktivitas::with('karyawan')
            ->terbaru(15)
            ->get();

        // ── Grafik transaksi stok 30 hari terakhir ───────────────────────────
        $grafikStok = StokTransaksi::select(
                'tipe',
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('SUM(jumlah) as total')
            )
            ->where('tanggal', '>=', now()->subDays(30))
            ->groupBy('tipe', 'tanggal')
            ->orderBy('tanggal')
            ->get()
            ->groupBy('tipe');

        // ── Top barang paling sering dipinjam ───────────────────────────────
        $topBarangDipinjam = Peminjaman::select('barang_id', DB::raw('COUNT(*) as frekuensi'), DB::raw('SUM(jumlah) as total_unit'))
            ->with('barang:id,nama_barang,kode_barang')
            ->groupBy('barang_id')
            ->orderByDesc('frekuensi')
            ->limit(5)
            ->get();

        return view('dashboard.optimal', compact(
            'totalBarang', 'totalUnit', 'barangBaik', 'barangRusak', 'barangDiperbaiki',
            'peminjamanAktif', 'totalDipinjam', 'peminjamanTerlambat',
            'maintenanceBerlangsung', 'jadwalAkanDatang', 'jadwalTerlambat',
            'logTerbaru', 'grafikStok', 'topBarangDipinjam'
        ));
    }
}
