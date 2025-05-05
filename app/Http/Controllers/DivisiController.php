<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
    $divisi = Divisi::all(); // Fetch all divisions from the database
   // dd($divisi); // Debugging line to check the data fetched
    return view('divisi.index', compact('divisi'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisi.create'); // Return the view for creating a new division
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
            'kode_divisi' => 'required',
            'nama_divisi' => 'required',
            'deskripsi' => 'nullable',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);
        
        Divisi::create([
            'kode_divisi' => $request->kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        return redirect()->route('divisi.index')->with('success', 'Divisi created successfully.');
        // Simpan data ke database
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        return view('divisi.show', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisi = Divisi::findOrFail($id);
        //dd($divisi); // Debugging line to check the data fetched
        return view('divisi.edit', compact('divisi'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_divisi' => 'required',
            'kode_divisi' => 'required',
            'nama_divisi' => 'required',
            'deskripsi' => 'nullable',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);
    
        $divisi = Divisi::findOrFail($id); // Ambil data berdasarkan ID
        $divisi->update([
            'id_divisi' => $request->id_divisi,
            'kode_divisi' => $request->kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
    
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $divisi = Divisi::findOrFail($id); // Cari data berdasarkan ID
    $divisi->delete(); // Hapus data dari database

    return redirect()->route('divisi.index')->with('success', 'Divisi berhasil dihapus.');
}
}
