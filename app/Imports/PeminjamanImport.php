<?php
namespace App\Imports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeminjamanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    return new Peminjaman([
        'barang_id'        => $row['barang_id'],
        'karyawan_id'      => $row['karyawan_id'],
        'jumlah'           => is_numeric($row['jumlah']) ? floor((float) $row['jumlah']) : 0,
        'tanggal_pinjam'   => isset($row['tanggal_pinjam']) && is_numeric($row['tanggal_pinjam'])
            ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_pinjam'])->format('Y-m-d')
            : ($row['tanggal_pinjam'] ?? null),
        'tanggal_kembali'  => isset($row['tanggal_kembali']) && is_numeric($row['tanggal_kembali'])
            ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_kembali'])->format('Y-m-d')
            : ($row['tanggal_kembali'] ?? null),
    ]);
}
}
//     * @return \Illuminate\Http\Response
//     */
//     public function store(Request $request)
//     {
//         $request->validate([
