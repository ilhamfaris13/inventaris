<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Divisi;
use Illuminate\Http\Request;

class KaryawanController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
    $karyawans = Karyawan::all(); // Fetch all data from the Karyawan model
    return view('karyawan.index', compact('karyawans')); // Pass the data to the view
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi = Divisi::all(); // Ambil semua data divisi
        return view('karyawan.create', compact('divisi')); // Kirim data divisi ke view
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
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'posisi' => 'required|exists:divisi,id', // Validasi posisi harus ada di tabel Divisi
        'gaji' => 'required|numeric|min:0',
        'tanggal_masuk' => 'required|date',
    ]);

    Karyawan::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'tanggal_lahir' => $request->tanggal_lahir,
        'posisi' => $request->posisi, // Simpan ID divisi
        'gaji' => str_replace(',', '', $request->gaji),
        'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');

    
            //dd($request);
            // Create a new karyawan instance and fill it with validated data
            $karyawan = new Karyawan();
            $karyawan->nama = $validatedData['nama'];
            $karyawan->alamat = $validatedData['alamat'];
            $karyawan->tanggal_lahir = $validatedData['tanggal_lahir'];
            $karyawan->posisi = $validatedData['posisi'];
            $karyawan->gaji = $validatedData['gaji'];
            $karyawan->tanggal_masuk = $validatedData['tanggal_masuk'];
            
            // Save the karyawan instance to the database

            $karyawan->save();
        
        // Save the karyawan data to the database
        return redirect()->route('karyawan.index')->with('success', 'Karyawan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate and update the karyawan data
        $karyawan = Karyawan::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required|integer',
            'gaji' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'posisi' => $request->posisi,
            'gaji' => str_replace(',', '', $request->gaji), // Hapus tanda koma sebelum menyimpan
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);
    

        return redirect()->route('karyawan.index')->with('success', 'Karyawan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $karyawan = Karyawan::findOrFail($id);
    $karyawan->delete();

    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }

}
