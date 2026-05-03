<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Import\DivisiImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourImportClass;

class DivisiController extends Controller
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
    $divisi = Divisi::all(); // Fetch all divisions from the database
   // dd($divisi); // Debugging line to check the data fetched
    return view('divisi.index', compact('divisi'));
}

    /**
     * Import data from an Excel file.
     *
     * @return \Illuminate\Http\Response
     */
public function import(Request $request)
{
    
//dd ($file);
    $file = $request->file('file');
    Excel::import(new DivisiImport, $file);
    

    return back()->with('success', 'Data berhasil di-import!');
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
            'kode_divisi' => 'required|unique:divisi,kode_divisi',
            'nama_divisi' => 'required',
            'deskripsi' => 'nullable',
        ]);
        
        Divisi::create([
            'kode_divisi' => $request->kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
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
    try {
        $divisi = Divisi::findOrFail($id);
        return view('divisi.edit', compact('divisi'));
    } catch (\Exception $e) {
        return redirect()->route('divisi.index')->with('error', 'Data Divisi tidak ditemukan.');
    }
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
            'kode_divisi' => 'required|unique:divisi,kode_divisi,' . $id,
            'nama_divisi' => 'required',
            'deskripsi' => 'nullable',
        ]);
    
        $divisi = Divisi::findOrFail($id); // Ambil data berdasarkan ID
        $divisi->update([
            'kode_divisi' => $request->kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
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
        try {
            $divisi = Divisi::findOrFail($id);
            $divisi->delete();
            return redirect()->route('divisi.index')->with('success', 'Divisi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('divisi.index')->with('error', 'Data Divisi tidak ditemukan.');
        }
    }
}
