<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintanance extends Model
{
    use HasFactory;
    protected $table = 'maintenance';
    protected $fillable = ['barang_id', 'teknisi_id', 'tanggal_perbaikan', 'deskripsi', 'status'];

    public function barang() {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function teknisi() {
        return $this->belongsTo(Karyawan::class, 'teknisi_id');
    }
}
