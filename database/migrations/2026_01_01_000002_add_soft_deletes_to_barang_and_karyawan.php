<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Menambahkan soft delete ke tabel barang dan karyawan
 * AMAN: Hanya menambah kolom deleted_at, tidak mengubah kolom yang ada
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            if (!Schema::hasColumn('barang', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('karyawan', function (Blueprint $table) {
            if (!Schema::hasColumn('karyawan', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
