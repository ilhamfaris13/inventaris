<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
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
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
       $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'tanggal_lahir' => 'required|date',
        'posisi' => 'nullable|string',
        'gaji' => 'required|numeric',
        'tanggal_masuk' => 'required|date',
    ]);
    
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

    Karyawan::create($validatedData);
        
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
            'gaji' => 'required|numeric',
        ]);

        //dd($request->all());
        $karyawan->update($request->all());

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
