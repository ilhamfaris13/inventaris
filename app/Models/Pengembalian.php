<?php
// ============================================================
// File: app/Models/Pengembalian.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'kondisi_barang',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'date',
    ];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function getKondisiBadgeAttribute(): string
    {
        return match ($this->kondisi_barang) {
            'baik'   => 'success',
            'rusak'  => 'danger',
            'hilang' => 'dark',
            default  => 'secondary',
        };
    }
}
