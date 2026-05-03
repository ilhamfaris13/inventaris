<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class JadwalMaintenance extends Model
{
    use HasFactory;

    protected $table = 'jadwal_maintenance';

    protected $fillable = [
        'barang_id',
        'teknisi_id',
        'jadwal_tanggal',
        'frekuensi',
        'keterangan',
        'status',
        'selesai_tanggal',
    ];

    protected $casts = [
        'jadwal_tanggal'  => 'date',
        'selesai_tanggal' => 'date',
    ];

    // ─── Relasi ──────────────────────────────────────────────────────────────

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'teknisi_id');
    }

    // ─── Accessor ────────────────────────────────────────────────────────────

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'terjadwal'  => 'warning',
            'selesai'    => 'success',
            'dibatalkan' => 'danger',
            default      => 'secondary',
        };
    }

    public function getIsTerlambatAttribute(): bool
    {
        return $this->status === 'terjadwal'
            && $this->jadwal_tanggal->isPast();
    }

    public function getHariMenujuJadwalAttribute(): int
    {
        return (int) now()->diffInDays($this->jadwal_tanggal, false);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeTerjadwal($query)
{
    return $query->where('status', 'terjadwal');
}

public function scopeAkanDatang($query, int $hari = 7)
{
    return $query->where('status', 'terjadwal')
        ->whereBetween('jadwal_tanggal', [
            now()->toDateString(),
            now()->addDays($hari)->toDateString(),
        ]);
}

public function scopeTerlambat($query)
{
    return $query->where('status', 'terjadwal')
        ->where('jadwal_tanggal', '<', now()->toDateString());
}

    // ─── Business Logic ──────────────────────────────────────────────────────

    /**
     * Tandai jadwal sebagai selesai dan buat jadwal berikutnya jika berkala
     */
    public function selesaikan(): void
    {
        $this->update([
            'status'          => 'selesai',
            'selesai_tanggal' => now()->toDateString(),
        ]);

        // Buat jadwal berikutnya jika frekuensi bukan sekali
        if ($this->frekuensi !== 'sekali') {
            $jadwalBerikutnya = match ($this->frekuensi) {
                'mingguan' => $this->jadwal_tanggal->addWeek(),
                'bulanan'  => $this->jadwal_tanggal->addMonth(),
                'tahunan'  => $this->jadwal_tanggal->addYear(),
            };

            self::create([
                'barang_id'     => $this->barang_id,
                'teknisi_id'    => $this->teknisi_id,
                'jadwal_tanggal' => $jadwalBerikutnya,
                'frekuensi'     => $this->frekuensi,
                'keterangan'    => $this->keterangan,
                'status'        => 'terjadwal',
            ]);
        }
    }
}
