<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubDpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_dpa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dpa_id'); // Foreign key to connect to DPA table
            $table->string('sub_kegiatan');
            $table->string('kode_rekening');
            $table->text('uraian');
            $table->string('jumlah');
            $table->string('koefisien');
            $table->string('satuan');
            $table->integer('harga');
            $table->text('sumber_dana');
            $table->string('jenis_barang');
            $table->string('jumlah_anggaran_sub_kegiatan');
            // Add the missing column definition
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_dpa');
    }
}

