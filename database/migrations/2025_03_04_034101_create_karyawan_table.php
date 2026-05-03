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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('alamat', 255)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->unsignedBigInteger('posisi')->nullable();
            $table->decimal('gaji', 15, 2)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->foreign('posisi')->references('id')->on('divisi')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('karyawan');
    }
};
