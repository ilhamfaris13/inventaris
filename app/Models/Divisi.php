<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $fillable = ['kode_divisi', 'nama_divisi', 'deskripsi'];

    public function karyawans(): HasMany
    {
        return $this->hasMany(Karyawan::class, 'posisi');
    }

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'kepemilikan_id');
    }
}
