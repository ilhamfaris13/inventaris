<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware untuk memastikan pengguna terautentikasi
    }

    public function index() {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create() {
        return view('kategori.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori|max:50',
            'deskripsi' => 'nullable',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id) {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function show($id) {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }
    
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255', // Pastikan field nama wajib diisi
        'deskripsi' => 'required|string',
    ]);

    $kategori = Kategori::findOrFail($id);
    $kategori->update([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
}

    public function destroy($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
// Compare this snippet from src/resources/views/kategori/index.blade.php:
