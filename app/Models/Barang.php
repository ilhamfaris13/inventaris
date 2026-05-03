<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Barang — versi optimal
 * AMAN: File baru, tidak menimpa model yang sudah ada
 * Letakkan di app/Models/Barang.php (gantikan yang lama jika belum ada relasi ini)
 */
class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'spesifikasi',
        'jumlah',
        'kondisi',
        'lokasi',
        'ruangan_id',
        'kepemilikan_id',
        'tanggal_masuk',
        'foto',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'jumlah'        => 'integer',
    ];

    // ─── Relasi ──────────────────────────────────────────────────────────────

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function kepemilikan(): BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'kepemilikan_id');
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'barang_id');
    }

    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'barang_id');
    }

    public function stokTransaksis(): HasMany
    {
        return $this->hasMany(StokTransaksi::class, 'barang_id');
    }

    public function jadwalMaintenances(): HasMany
    {
        return $this->hasMany(JadwalMaintenance::class, 'barang_id');
    }

    // ─── Accessor ────────────────────────────────────────────────────────────

    public function getKondisiBadgeAttribute(): string
    {
        return match ($this->kondisi) {
            'baik'       => 'success',
            'rusak'      => 'danger',
            'diperbaiki' => 'warning',
            default      => 'secondary',
        };
    }

    public function getFotoUrlAttribute(): string
    {
        return $this->foto
            ? asset('storage/' . $this->foto)
            : asset('images/no-image.png');
    }

    public function getJumlahDipinjamAttribute(): int
    {
        return $this->peminjamans()->where('status', 'dipinjam')->sum('jumlah');
    }

    public function getJumlahTersediaAttribute(): int
    {
        return max(0, $this->jumlah - $this->jumlah_dipinjam);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeSearch($query, ?string $keyword)
    {
        if (!$keyword) return $query;
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_barang', 'like', "%{$keyword}%")
              ->orWhere('kode_barang', 'like', "%{$keyword}%")
              ->orWhere('lokasi', 'like', "%{$keyword}%");
        });
    }

    public function scopeKondisi($query, ?string $kondisi)
    {
        if (!$kondisi) return $query;
        return $query->where('kondisi', $kondisi);
    }

    public function scopeByKategori($query, ?int $kategoriId)
    {
        if (!$kategoriId) return $query;
        return $query->where('kategori_id', $kategoriId);
    }

    public function scopeByRuangan($query, ?int $ruanganId)
    {
        if (!$ruanganId) return $query;
        return $query->where('ruangan_id', $ruanganId);
    }

    // ─── Default eager loads untuk mencegah N+1 ──────────────────────────────

    protected $with = ['kategori', 'kepemilikan', 'ruangan'];
}
