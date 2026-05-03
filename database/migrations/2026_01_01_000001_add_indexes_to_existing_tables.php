<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Menambahkan index ke tabel yang sudah ada
 * AMAN: Tidak mengubah atau menghapus kolom/tabel existing
 */
return new class extends Migration
{
    public function up(): void
    {
        // Index untuk tabel barang
        Schema::table('barang', function (Blueprint $table) {
            if (!$this->indexExists('barang', 'idx_kondisi')) {
                $table->index('kondisi', 'idx_kondisi');
            }
            if (!$this->indexExists('barang', 'idx_lokasi')) {
                $table->index('lokasi', 'idx_lokasi');
            }
            if (!$this->indexExists('barang', 'idx_tanggal_masuk')) {
                $table->index('tanggal_masuk', 'idx_tanggal_masuk');
            }
        });

        // Index untuk tabel peminjaman
        Schema::table('peminjaman', function (Blueprint $table) {
            if (!$this->indexExists('peminjaman', 'idx_peminjaman_status')) {
                $table->index('status', 'idx_peminjaman_status');
            }
            if (!$this->indexExists('peminjaman', 'idx_tanggal_pinjam')) {
                $table->index('tanggal_pinjam', 'idx_tanggal_pinjam');
            }
        });

        // Index untuk tabel maintenance
        Schema::table('maintenance', function (Blueprint $table) {
            if (!$this->indexExists('maintenance', 'idx_maintenance_status')) {
                $table->index('status', 'idx_maintenance_status');
            }
            if (!$this->indexExists('maintenance', 'idx_tanggal_perbaikan')) {
                $table->index('tanggal_perbaikan', 'idx_tanggal_perbaikan');
            }
        });

        // Index untuk tabel log_aktivitas
        Schema::table('log_aktivitas', function (Blueprint $table) {
            if (!$this->indexExists('log_aktivitas', 'idx_log_timestamp')) {
                $table->index('timestamp', 'idx_log_timestamp');
            }
        });

        // Composite index untuk stok_transaksi
        Schema::table('stok_transaksi', function (Blueprint $table) {
            if (!$this->indexExists('stok_transaksi', 'idx_barang_tanggal')) {
                $table->index(['barang_id', 'tanggal'], 'idx_barang_tanggal');
            }
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropIndexIfExists('idx_kondisi');
            $table->dropIndexIfExists('idx_lokasi');
            $table->dropIndexIfExists('idx_tanggal_masuk');
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropIndexIfExists('idx_peminjaman_status');
            $table->dropIndexIfExists('idx_tanggal_pinjam');
        });

        Schema::table('maintenance', function (Blueprint $table) {
            $table->dropIndexIfExists('idx_maintenance_status');
            $table->dropIndexIfExists('idx_tanggal_perbaikan');
        });

        Schema::table('log_aktivitas', function (Blueprint $table) {
            $table->dropIndexIfExists('idx_log_timestamp');
        });

        Schema::table('stok_transaksi', function (Blueprint $table) {
            $table->dropIndexIfExists('idx_barang_tanggal');
        });
    }

    /**
     * Cek apakah index sudah ada — mencegah error jika migration dijalankan ulang
     */
    private function indexExists(string $table, string $indexName): bool
    {
        $indexes = \DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$indexName]);
        return count($indexes) > 0;
    }
};
