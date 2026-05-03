<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = ['karyawan_id', 'aktivitas', 'timestamp'];

    protected $casts = ['timestamp' => 'datetime'];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id')->withTrashed();
    }

    /**
     * Catat aktivitas baru — helper statis agar mudah dipanggil dari mana saja
     */
    public static function catat(string $aktivitas, ?int $karyawanId = null): self
    {
        return self::create([
            'karyawan_id' => $karyawanId ?? auth()->id(),
            'aktivitas'   => $aktivitas,
            'timestamp'   => now(),
        ]);
    }

    public function scopeHariIni($query)
    {
        return $query->whereDate('timestamp', today());
    }

    public function scopeTerbaru($query, int $limit = 20)
    {
        return $query->orderByDesc('timestamp')->limit($limit);
    }
}
