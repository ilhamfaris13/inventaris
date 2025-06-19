<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Imports\PengembalianImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman.karyawan', 'peminjaman.barang'])->get();
        return view('pengembalian.index', compact('pengembalian'));

    }
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);
//dd($request->file('file'));
    Excel::import(new PengembalianImport, $request->file('file'));

    return redirect()->back()->with('success', 'Data berhasil diimport!');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peminjamans = Peminjaman::all();
        $pengembalian = Pengembalian::with(['karyawan', 'barang'])->get();
        return view('pengembalian.create', compact('pengembalian', 'peminjamans'));
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
            'peminjaman_id' => 'required',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Pengembalian::create($request->all());

        

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembalian $pengembalian)
    {
        return view('pengembalian.show', compact('pengembalian', 'peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $pengembalian = Pengembalian::findOrFail($id);

    $request->validate([
        'tanggal_pengembalian' => 'required|date',
        'kondisi_barang' => 'required|in:baik,rusak,hilang',
        'keterangan' => 'nullable|string',
    ]);

    $pengembalian->update($request->only([
        'tanggal_pengembalian', 'kondisi_barang', 'keterangan'
    ]));

    return redirect()->route('pengembalian.index')->with('success', 'Data berhasil diupdate.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
        
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus!');
    }
}
