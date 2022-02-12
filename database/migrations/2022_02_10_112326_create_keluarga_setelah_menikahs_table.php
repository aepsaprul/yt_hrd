<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaSetelahMenikahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga_setelah_menikahs', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->string('hubungan', 15)->nullable();
            $table->string('nama', 30)->nullable();
            $table->integer('usia')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('pendidikan_terakhir', 30)->nullable();
            $table->string('pekerjaan_terakhir', 30)->nullable();
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
        Schema::dropIfExists('keluarga_setelah_menikahs');
    }
}
