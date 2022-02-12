<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->integer('nik')->nullable();
            $table->string('nama_lengkap', 30)->nullable();
            $table->string('nama_panggilan', 15)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('nomor_ktp')->nullable();
            $table->string('status_ktp', 30)->nullable();
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama', 10)->nullable();
            $table->char('gender', 1)->nullable();
            $table->text('alamat_asal')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->char('jenis_sim', 1)->nullable();
            $table->integer('nomor_sim')->nullable();
            $table->integer('cabang_id')->nullable();
            $table->integer('jabatan_id')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->text('alasan_keluar')->nullable();
            $table->integer('total_cuti')->nullable();
            $table->string('foto', 100)->nullable();
            $table->enum('status_keryawan', ['aktif', 'nonaktif']);
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
        Schema::dropIfExists('karyawans');
    }
}
