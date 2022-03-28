<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti_details', function (Blueprint $table) {
            $table->id();
            $table->integer('cuti_id')->nullable();
            $table->tinyInteger('hirarki')->nullable();
            $table->text('atasan_id')->nullable();
            $table->char('status', 1)->nullable();
            $table->char('confirm', 1)->nullable();
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
        Schema::dropIfExists('cuti_details');
    }
}
