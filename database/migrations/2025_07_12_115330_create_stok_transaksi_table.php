<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('stok_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->enum('tipe', ['masuk', 'keluar', 'penyesuaian']);
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_transaksi');
    }
}
