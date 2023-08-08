<?php
// database/migrations/2023_08_01_100000_create_arsip_lamas_table.php
// database/migrations/2023_08_01_100000_create_arsip_lamas_table.php

// database/migrations/2023_08_01_100000_create_arsip_lamas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipLamasTable extends Migration
{
    public function up()
    {
        Schema::create('arsip_lamas', function (Blueprint $table) {
            $table->id();
            $table->string('no_spm')->nullable();
            $table->string('tanggal_spm')->nullable();
            $table->decimal('nilai_spm', 10, 2)->nullable();
            $table->string('terbilang')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('uraian_belanja')->nullable();
            $table->string('sub_kegiatan')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('nama')->nullable();
            $table->decimal('pph_21', 10, 2)->nullable();
            $table->decimal('pph_22', 10, 2)->nullable();
            $table->decimal('pph_23', 10, 2)->nullable();
            $table->decimal('ppn', 10, 2)->nullable();
            $table->decimal('ppnd', 10, 2)->nullable();
            $table->string('lain_lain')->nullable();
            $table->date('tanggal_sp2d')->nullable();
            $table->string('no_sp2d')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_lamas');
    }
}




