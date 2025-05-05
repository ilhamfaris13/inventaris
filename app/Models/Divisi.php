<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
        'deskripsi',
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
    public function karyawan() {
        return $this->hasMany(Karyawan::class, 'posisi');
    }

    public function barang() {
        return $this->hasMany(Barang::class, 'kepemilikan_id');
    }
}
