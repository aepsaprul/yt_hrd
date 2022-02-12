<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->string('tingkat', 30)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('kota', 30)->nullable();
            $table->string('jurusan', 50)->nullable();
            $table->date('tahun_masuk')->nullable();
            $table->date('tahun_lulus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pendidikans');
    }
}
