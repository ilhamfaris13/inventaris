<?php

namespace App\Http\Controllers;

use App\Models\JadwalMaintenance;
use App\Models\Barang;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class JadwalMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalMaintenance::with(['barang', 'teknisi']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->q) {
            $query->whereHas('barang', fn($q) => $q->where('nama_barang', 'like', "%{$request->q}%"));
        }

        $jadwals = $query->orderBy('jadwal_tanggal')->paginate(15)->withQueryString();

        $terlambatCount  = JadwalMaintenance::terlambat()->count();
        $akanDatangCount = JadwalMaintenance::akanDatang(7)->count();

        return view('jadwal-maintenance.index', compact('jadwals', 'terlambatCount', 'akanDatangCount'));
    }

    public function create()
    {
        $barangs   = Barang::orderBy('nama_barang')->get(['id', 'nama_barang', 'kode_barang']);
        $teknisis  = Karyawan::orderBy('nama')->get(['id', 'nama']);
        return view('jadwal-maintenance.create', compact('barangs', 'teknisis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id'     => 'required|exists:barang,id',
            'teknisi_id'    => 'nullable|exists:karyawan,id',
            'jadwal_tanggal' => 'required|date',
            'frekuensi'     => 'required|in:sekali,mingguan,bulanan,tahunan',
            'keterangan'    => 'nullable|string',
        ]);

        JadwalMaintenance::create($validated);

        return redirect()->route('jadwal-maintenance.index')
            ->with('success', 'Jadwal maintenance berhasil dibuat.');
    }

    public function show(JadwalMaintenance $jadwalMaintenance)
    {
        $jadwalMaintenance->load(['barang', 'teknisi']);
        return view('jadwal-maintenance.show', compact('jadwalMaintenance'));
    }

    public function edit(JadwalMaintenance $jadwalMaintenance)
    {
        $barangs  = Barang::orderBy('nama_barang')->get(['id', 'nama_barang', 'kode_barang']);
        $teknisis = Karyawan::orderBy('nama')->get(['id', 'nama']);
        return view('jadwal-maintenance.edit', compact('jadwalMaintenance', 'barangs', 'teknisis'));
    }

    public function update(Request $request, JadwalMaintenance $jadwalMaintenance)
    {
        $validated = $request->validate([
            'barang_id'     => 'required|exists:barang,id',
            'teknisi_id'    => 'nullable|exists:karyawan,id',
            'jadwal_tanggal' => 'required|date',
            'frekuensi'     => 'required|in:sekali,mingguan,bulanan,tahunan',
            'keterangan'    => 'nullable|string',
            'status'        => 'required|in:terjadwal,selesai,dibatalkan',
        ]);

        $jadwalMaintenance->update($validated);

        return redirect()->route('jadwal-maintenance.index')
            ->with('success', 'Jadwal maintenance berhasil diperbarui.');
    }

    public function selesaikan(JadwalMaintenance $jadwalMaintenance)
    {
        if ($jadwalMaintenance->status !== 'terjadwal') {
            return back()->with('error', 'Jadwal ini sudah tidak aktif.');
        }

        $jadwalMaintenance->selesaikan();

        return back()->with('success', 'Jadwal ditandai selesai. Jadwal berikutnya telah dibuat secara otomatis (jika berkala).');
    }

    public function destroy(JadwalMaintenance $jadwalMaintenance)
    {
        $jadwalMaintenance->update(['status' => 'dibatalkan']);

        return redirect()->route('jadwal-maintenance.index')
            ->with('success', 'Jadwal maintenance dibatalkan.');
    }
}
