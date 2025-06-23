<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = ['peminjaman_id','tanggal_pengembalian','kondisi_barang','keterangan'];
    
    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function barang() {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}

