<?php

namespace App\Imports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengembalianImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pengembalian([
            'peminjaman_id'        => $row['peminjaman_id'] ,
            'tanggal_pengembalian' => $row['tanggal_pengembalian'] ?? null,
            'kondisi_barang'       => $row['kondisi_barang'] ?? null,
            'keterangan'           => $row['keterangan'] ?? null,
        ]);
    }
}
