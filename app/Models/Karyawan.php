<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'alamat',
        'tanggal_lahir',
        'posisi',
        'tanggal_masuk',
    ];

    // gaji sengaja tidak di fillable (data sensitif)
    protected $hidden = ['gaji'];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    // ─── Relasi ──────────────────────────────────────────────────────────────

    public function divisi(): BelongsTo
    {
        // kolom 'posisi' merujuk ke divisi.id (nama kolom lama dipertahankan)
        return $this->belongsTo(Divisi::class, 'posisi');
    }

    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'karyawan_id');
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'teknisi_id');
    }

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'karyawan_id');
    }

    public function jadwalMaintenances(): HasMany
    {
        return $this->hasMany(JadwalMaintenance::class, 'teknisi_id');
    }

    // ─── Accessor ────────────────────────────────────────────────────────────

    public function getNamaLengkapDivisiAttribute(): string
    {
        return $this->nama . ($this->divisi ? ' — ' . $this->divisi->nama_divisi : '');
    }

    public function getUmurAttribute(): ?int
    {
        return $this->tanggal_lahir?->age;
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeSearch($query, ?string $keyword)
    {
        if (!$keyword) return $query;
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama', 'like', "%{$keyword}%")
              ->orWhere('alamat', 'like', "%{$keyword}%");
        });
    }

    public function scopeByDivisi($query, ?int $divisiId)
    {
        if (!$divisiId) return $query;
        return $query->where('posisi', $divisiId);
    }
}
