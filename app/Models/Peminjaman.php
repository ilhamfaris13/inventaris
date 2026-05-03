<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'karyawan_id',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    protected $casts = [
        'tanggal_pinjam'  => 'date',
        'tanggal_kembali' => 'date',
        'jumlah'          => 'integer',
    ];

    // ─── Relasi ──────────────────────────────────────────────────────────────

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id')->withTrashed();
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }

    // ─── Accessor ────────────────────────────────────────────────────────────

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'dipinjam' ? 'warning' : 'success';
    }

    public function getDurasiHariAttribute(): int
    {
        $akhir = $this->tanggal_kembali ?? now();
        return (int) $this->tanggal_pinjam->diffInDays($akhir);
    }

    public function getIsTerlambatAttribute(): bool
    {
        return $this->status === 'dipinjam'
            && $this->tanggal_kembali
            && $this->tanggal_kembali->isPast();
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeAktif($query)
    {
        return $query->where('status', 'dipinjam');
    }

    public function scopeTerlambat($query)
    {
        return $query->where('status', 'dipinjam')
            ->whereNotNull('tanggal_kembali')
            ->where('tanggal_kembali', '<', now());
    }

    public function scopePeriode($query, ?string $dari, ?string $sampai)
    {
        if ($dari)   $query->where('tanggal_pinjam', '>=', $dari);
        if ($sampai) $query->where('tanggal_pinjam', '<=', $sampai);
        return $query;
    }
}
