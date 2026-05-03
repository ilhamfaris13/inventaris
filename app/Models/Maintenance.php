<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance';

    protected $fillable = [
        'barang_id',
        'teknisi_id',
        'tanggal_perbaikan',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal_perbaikan' => 'date',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id')->withTrashed();
    }

    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'teknisi_id')->withTrashed();
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'diperbaiki' ? 'warning' : 'success';
    }

    public function scopeBerlangsung($query)
    {
        return $query->where('status', 'diperbaiki');
    }
}
