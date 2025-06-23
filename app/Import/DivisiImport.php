<?php

namespace App\Import;

use App\Models\Divisi;
use Maatwebsite\Excel\Concerns\ToModel;

class DivisiImport implements ToModel
{
    public function model(array $row)
    {
        return new Divisi([
            'kode_divisi' => $row[0],
            'nama_divisi' => $row[1],
            'deskripsi' => $row[2],
            // sesuaikan kolomnya sama di excel kamu ya
        ]);
    }
}
