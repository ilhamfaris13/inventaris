<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Divisi;
use Excel;

class DivisiImportController extends Controller
{
    public function index()
    {
        return view('import-divisi');
    }

    public function preview(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();

        if ($data->count()) {
            return view('preview-divisi', ['data' => $data]);
        }

        return back()->with('error', 'File kosong atau tidak sesuai format.');
    }

    public function process(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();

        if ($data->count()) {
            foreach ($data as $row) {
                Divisi::create([
                    'nama_divisi' => $row->nama_divisi,
                ]);
            }
        }

        return redirect('/import-divisi')->with('success', 'Data divisi berhasil diimport!');
    }
}
