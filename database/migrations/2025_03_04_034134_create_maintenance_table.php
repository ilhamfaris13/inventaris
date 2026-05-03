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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->date('tanggal_perbaikan');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['diperbaiki', 'selesai'])->default('diperbaiki');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('id')->on('karyawan')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('maintenance');
    }
};
