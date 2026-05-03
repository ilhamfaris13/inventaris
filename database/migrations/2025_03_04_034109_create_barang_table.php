<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50)->unique();
            $table->string('nama_barang', 100);
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->integer('jumlah')->default(1);
            $table->enum('kondisi', ['baik', 'rusak', 'diperbaiki'])->default('baik');
            $table->string('lokasi', 100)->nullable();
            $table->unsignedBigInteger('kepemilikan_id')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');
            $table->foreign('kepemilikan_id')->references('id')->on('divisi')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('barang');
    }
};
