<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokTransaksi extends Model
{
    use HasFactory;

    protected $table = 'stok_transaksi';

    protected $fillable = [
        'barang_id',
        'tipe',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
