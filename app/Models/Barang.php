<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 'nama_barang', 'kategori_id', 'spesifikasi', 'jumlah', 'kondisi', 'lokasi', 'kepemilikan_id', 'tanggal_masuk', 'foto'];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function divisi() {
        return $this->belongsTo(Divisi::class, 'kepemilikan_id');
    }

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class, 'barang_id');
    }

    public function maintenance() {
        return $this->hasMany(Maintenance::class, 'barang_id');
    }
}
