<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang; // Ensure Barang model is imported
use App\Models\Karyawan; // Ensure Karyawan model is imported
use Illuminate\Http\Request;
use App\Imports\PeminjamanImport;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }

    public function import(Request $request)
{
    $file = $request->file('file');

try {
    Excel::import(new PeminjamanImport, $file);
    return back()->with('success', 'Data berhasil diimport.');
} catch (\Throwable $e) {
    return back()->with('error', 'Gagal import: ' . $e->getMessage());
}
}
    public function index()
    {
        $peminjaman = Peminjaman::all(); // Ambil semua data peminjaman
        return view('peminjaman.index', compact('peminjaman')); // Kirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $barangAll = Barang::all(); // Fetch all barang for the dropdown
        $karyawan = Karyawan::all(); // Fetch all karyawan for the dropdown
        $barang = null;

    if ($request->has('barang_id')) {
        $barang = Barang::find($request->barang_id);
    }

    //return view('peminjaman.create', compact('barang'));
        return view('peminjaman.create', compact('barang',  'karyawan','barangAll')); // Pass the data to the view
    // Return the view for creating a new peminjaman

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'id' => 'required|unique:peminjaman,id',
        'karyawan_id' => 'required|exists:karyawan,id',
        'barang_id' => 'required|exists:barang,id',
        'jumlah' => 'required|integer|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required|in:pinjam,kembali',
        'created_at' => 'required|date',
        'updated_at' => 'required|date',
    ]);

    Peminjaman::create([
        'id' => $request->id,
        'karyawan_id' => $request->karyawan_id,
        'barang_id' => $request->barang_id,
        'jumlah' => $request->jumlah,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => $request->status,
    ]);

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman')); // Return the view for showing a specific peminjaman
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
public function edit($id)
{
    $peminjaman = Peminjaman::findOrFail($id); // Ambil data berdasarkan ID
    $barang = Barang::all(); // Fetch all barang for the dropdown
    $karyawan = Karyawan::all(); // Fetch all karyawan for the dropdown
    return view('peminjaman.edit', compact('peminjaman', 'barang', 'karyawan')); // Kirim data ke view
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    
public function update(Request $request, $id)
{
    $request->validate([
        'karyawan_id' => 'required|exists:karyawan,id',
        'barang_id' => 'required|exists:barang,id',
        'jumlah' => 'required|integer|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required|in:pinjam,kembali',
    ]);

    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->update([
        'karyawan_id' => $request->karyawan_id,
        'barang_id' => $request->barang_id,
        'jumlah' => $request->jumlah,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => $request->status,
    ]);

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */

public function destroy($id)
{
    $peminjaman = Peminjaman::findOrFail($id); // Cari data berdasarkan ID
    $peminjaman->delete(); // Hapus data

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
}
}
