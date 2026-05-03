<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokTransaksi extends Model
{
    protected $table = 'stok_transaksi';
    protected $fillable = ['barang_id','tipe','jumlah','tanggal','keterangan'];
    protected $casts = ['tanggal' => 'date', 'jumlah' => 'integer'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id')->withTrashed();
    }

    public function getTipeBadgeAttribute(): string
    {
        return match ($this->tipe) {
            'masuk'       => 'success',
            'keluar'      => 'danger',
            'penyesuaian' => 'info',
            default       => 'secondary',
        };
    }

    public function scopePeriode($query, ?string $dari, ?string $sampai)
    {
        if ($dari)   $query->where('tanggal', '>=', $dari);
        if ($sampai) $query->where('tanggal', '<=', $sampai);
        return $query;
    }
}
