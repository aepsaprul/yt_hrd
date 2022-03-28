<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_accesses', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->integer('main_id')->nullable();
            $table->integer('sub_id')->nullable();
            $table->char('tampil', 1)->nullable();
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
        Schema::dropIfExists('nav_accesses');
    }
}
