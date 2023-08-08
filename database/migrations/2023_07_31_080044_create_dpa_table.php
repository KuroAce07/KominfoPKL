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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dpa');
    }
}
