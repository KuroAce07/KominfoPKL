<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class realisasi extends Migration
{
    public function up()
    {
        Schema::create('realisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dpa_id')->nullable();
            $table->decimal('bulan_1', 15, 2)->nullable();
            $table->decimal('bulan_2', 15, 2)->nullable();
            $table->decimal('bulan_3', 15, 2)->nullable();
            $table->decimal('bulan_4', 15, 2)->nullable();
            $table->decimal('bulan_5', 15, 2)->nullable();
            $table->decimal('bulan_6', 15, 2)->nullable();
            $table->decimal('bulan_7', 15, 2)->nullable();
            $table->decimal('bulan_8', 15, 2)->nullable();
            $table->decimal('bulan_9', 15, 2)->nullable();
            $table->decimal('bulan_10', 15, 2)->nullable();
            $table->decimal('bulan_11', 15, 2)->nullable();
            $table->decimal('bulan_12', 15, 2)->nullable();
            $table->decimal('total_rak', 15, 2)->nullable();
            // ... add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('realisasi');
    }
}

