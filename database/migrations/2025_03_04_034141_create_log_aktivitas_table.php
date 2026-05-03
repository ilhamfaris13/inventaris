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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id')->nullable();
            $table->text('aktivitas');
            $table->timestamp('timestamp')->useCurrent();
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('log_aktivitas');
    }
};
