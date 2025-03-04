<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = ['karyawan_id', 'barang_id', 'jumlah', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function barang() {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function pengembalian() {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }
}
