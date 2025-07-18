<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Divisi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); // Middleware untuk memastikan pengguna terautentikasi
    }

    public function index()
    {
        // Mengambil data barang dengan relasi kategori dan divisi
        $barang = Barang::with('kategori', 'divisi')->get();
        // Mengirim data barang ke view index
        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all(); // Mengambil data kategori
        $divisi = Divisi::all(); // Mengambil data divisi
        return view('barang.create', compact('kategori', 'divisi')); // Mengirim data kategori dan divisi ke view create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validasi semua data termasuk foto
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang|max:50',
            'nama_barang' => 'required|max:100',
            'kategori_id' => 'nullable|exists:kategori,id',
            'spesifikasi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak,diperbaiki',
            'lokasi' => 'nullable|string|max:100',
            'kepemilikan_id' => 'nullable|exists:divisi,id',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
    
        // 2. Cek dan simpan file foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $filename);
            $validated['foto'] = 'uploads/barang/' . $filename;
        }
    
        // 3. Simpan data ke DB
        Barang::create($validated);
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Menambahkan parameter id 
    {
        $barang = Barang::with('kategori', 'divisi')->findOrFail($id);  // Mengambil data barang dengan relasi kategori dan divisi berdasarkan id 
        return view('barang.show', compact('barang')); // Mengirim data barang ke view show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // Menambahkan parameter id 
    {
        $barang = Barang::findOrFail($id); // Mengambil data barang berdasarkan id 
        $kategori = Kategori::all(); // Mengambil data kategori
        $divisi = Divisi::all(); // Mengambil data divisi
        return view('barang.edit', compact('barang', 'kategori', 'divisi')); // Mengirim data barang, kategori, dan divisi ke view edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Menambahkan parameter request dan id 
    {
        $barang = Barang::findOrFail($id); // Mengambil data barang berdasarkan id
        //dd($request->all()); // Debugging untuk melihat data request yang diterima
    $request->validate([
        'kode_barang' => 'required|max:50|unique:barang,kode_barang,' . $id, // Menambahkan validasi kode_barang dan unik di tabel barang kecuali id yang sedang diedit 
        'nama_barang' => 'required|max:100', // Menambahkan validasi nama_barang dan maksimal 100 karakter 
        'kategori_id' => 'nullable|exists:kategori,id', // Menambahkan validasi kategori_id dan relasi ke tabel kategori 
        'spesifikasi' => 'nullable|string', // Menambahkan validasi spesifikasi dan tipe data string 
        'jumlah' => 'required|integer|min:1', // Menambahkan validasi jumlah dan minimal 1 
        'kondisi' => 'required|in:baik,rusak,diperbaiki', // Menambahkan validasi kondisi dan pilihan baik, rusak, diperbaiki
        'lokasi' => 'nullable|string|max:100', // Menambahkan validasi lokasi dan maksimal 100 karakter 
        'kepemilikan_id' => 'nullable|exists:divisi,id', // Menambahkan validasi kepemilikan_id dan relasi ke tabel divisi
        'tanggal_masuk' => 'required|date', // Menambahkan validasi tanggal_masuk dan tipe data date
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Menambahkan validasi foto dengan tipe gambar dan ukuran maksimal 2MB
    ]);
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan di public/uploads/barang
        $file->move(public_path('uploads/barang'), $filename);

        // Simpan path relatif ke database
        $validated['foto'] = 'uploads/barang/' . $filename;
    }

    //$barang->update($request->all()); // Mengupdate data barang dengan data dari request 
    $barang->update($validated);
    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!'); // Redirect ke halaman index barang dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id) // Menambahkan parameter id
    {
        $barang = Barang::findOrFail($id); // Mengambil data barang berdasarkan id
        $barang->delete(); // Menghapus data barang
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!'); // Redirect ke halaman index barang dengan pesan sukses
    }
    public function scan()
{
    return view('barang.scan');
}

public function scanResult(Request $request)
{
    $request->validate([
        'kode_barang' => 'required'
    ]);

    $barang = Barang::where('kode_barang', $request->kode_barang)->first();

    return view('barang.scan', compact('barang'));
}

}
