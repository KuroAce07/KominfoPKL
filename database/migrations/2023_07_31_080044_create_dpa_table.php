<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpaTable extends Migration
{
    public function up()
    {
        Schema::create('dpa', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dpa');
            $table->string('urusan_pemerintahan');
            $table->string('bidang_urusan');
            $table->string('program');
            $table->string('kegiatan');
            $table->string('dana');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id2')->nullable();
            $table->foreign('user_id2')->references('id')->on('users');
            $table->unsignedBigInteger('user_id3')->nullable();
            $table->foreign('user_id3')->references('id')->on('users');
            $table->unsignedBigInteger('user_id4')->nullable();
            $table->foreign('user_id4')->references('id')->on('users');
            $table->unsignedBigInteger('rekanan_id')->nullable();
            $table->foreign('rekanan_id')->references('id')->on('rekanans');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dpa');
    }
}
