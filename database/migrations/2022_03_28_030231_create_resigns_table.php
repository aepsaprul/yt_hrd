<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resigns', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('alasan', 100)->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->integer('approved_leader')->nullable();
            $table->string('approved_text', 50)->nullable();
            $table->string('approved_percentage', 5)->nullable();
            $table->string('approved_background', 15)->nullable();
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
        Schema::dropIfExists('resigns');
    }
}
