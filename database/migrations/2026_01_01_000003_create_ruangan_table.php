<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Membuat tabel ruangan baru
 * AMAN: Tabel baru, tidak menyentuh tabel yang sudah ada
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ruangan')) {
            Schema::create('ruangan', function (Blueprint $table) {
                $table->id();
                $table->string('kode_ruangan', 20)->unique();
                $table->string('nama_ruangan', 100);
                $table->integer('kapasitas')->nullable();
                $table->tinyInteger('lantai')->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Tambah kolom ruangan_id ke barang jika belum ada
        Schema::table('barang', function (Blueprint $table) {
            if (!Schema::hasColumn('barang', 'ruangan_id')) {
                $table->foreignId('ruangan_id')
                    ->nullable()
                    ->after('lokasi')
                    ->constrained('ruangan')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            if (Schema::hasColumn('barang', 'ruangan_id')) {
                $table->dropForeign(['ruangan_id']);
                $table->dropColumn('ruangan_id');
            }
        });

        Schema::dropIfExists('ruangan');
    }
};
