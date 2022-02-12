<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->string('nama_perusahaan', 30)->nullable();
            $table->string('jenis_industri', 30)->nullable();
            $table->string('jabatan_awal', 30)->nullable();
            $table->string('jabatan_akhir', 30)->nullable();
            $table->date('tahun_kerja_awal')->nullable();
            $table->date('tahun_kerja_akhir')->nullable();
            $table->double('gaji_awal')->nullable();
            $table->double('gaji_akhir')->nullable();
            $table->string('nama_atasan')->nullable();
            $table->string('alasan_berhenti', 100)->nullable();
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
        Schema::dropIfExists('riwayat_pekerjaans');
    }
}
