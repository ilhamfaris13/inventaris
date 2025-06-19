<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPosisiToKaryawanTable extends Migration
{
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->unsignedBigInteger('posisi')->after('tanggal_lahir');
            $table->foreign('posisi')->references('id')->on('divisi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropForeign(['posisi']);
            $table->dropColumn('posisi');
        });
    }
}