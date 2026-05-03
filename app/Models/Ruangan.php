<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruangan';

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'kapasitas',
        'lantai',
        'keterangan',
    ];

    protected $casts = [
        'kapasitas' => 'integer',
        'lantai'    => 'integer',
    ];

    // ─── Relasi ──────────────────────────────────────────────────────────────

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'ruangan_id');
    }

    // ─── Accessor ────────────────────────────────────────────────────────────

    public function getTotalBarangAttribute(): int
    {
        return $this->barangs()->count();
    }

    public function getLantaiLabelAttribute(): string
    {
        return $this->lantai ? "Lantai {$this->lantai}" : '-';
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeSearch($query, ?string $keyword)
    {
        if (!$keyword) return $query;
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_ruangan', 'like', "%{$keyword}%")
              ->orWhere('kode_ruangan', 'like', "%{$keyword}%");
        });
    }
}
