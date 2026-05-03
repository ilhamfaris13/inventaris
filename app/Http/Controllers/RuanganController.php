<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $ruangans = Ruangan::search($request->q)
            ->withCount('barangs')
            ->orderBy('kode_ruangan')
            ->paginate(15)
            ->withQueryString();

        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ruangan'  => 'required|string|max:20|unique:ruangan,kode_ruangan',
            'nama_ruangan'  => 'required|string|max:100',
            'kapasitas'     => 'nullable|integer|min:1',
            'lantai'        => 'nullable|integer|min:1|max:99',
            'keterangan'    => 'nullable|string',
        ]);

        Ruangan::create($validated);

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Ruangan $ruangan)
    {
        $ruangan->load(['barangs.kategori', 'barangs.kepemilikan']);
        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $validated = $request->validate([
            'kode_ruangan'  => ['required','string','max:20', Rule::unique('ruangan','kode_ruangan')->ignore($ruangan->id)],
            'nama_ruangan'  => 'required|string|max:100',
            'kapasitas'     => 'nullable|integer|min:1',
            'lantai'        => 'nullable|integer|min:1|max:99',
            'keterangan'    => 'nullable|string',
        ]);

        $ruangan->update($validated);

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        // Cek apakah ada barang di ruangan ini
        if ($ruangan->barangs()->exists()) {
            return back()->with('error', 'Ruangan tidak dapat dihapus karena masih memiliki barang.');
        }

        $ruangan->delete();

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}
