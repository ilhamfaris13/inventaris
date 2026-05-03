<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Membuat tabel jadwal_maintenance baru
 * AMAN: Tabel baru, tidak menyentuh tabel yang sudah ada
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('jadwal_maintenance')) {
            Schema::create('jadwal_maintenance', function (Blueprint $table) {
                $table->id();
                $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete();
                $table->foreignId('teknisi_id')->nullable()->constrained('karyawan')->nullOnDelete();
                $table->date('jadwal_tanggal');
                $table->enum('frekuensi', ['sekali', 'mingguan', 'bulanan', 'tahunan'])->default('sekali');
                $table->text('keterangan')->nullable();
                $table->enum('status', ['terjadwal', 'selesai', 'dibatalkan'])->default('terjadwal');
                $table->date('selesai_tanggal')->nullable();
                $table->timestamps();

                $table->index('jadwal_tanggal');
                $table->index('status');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_maintenance');
    }
};
