<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerabatDaruratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerabat_darurats', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->string('hubungan', 15)->nullable();
            $table->string('nama', 30)->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('kerabat_darurats');
    }
}
