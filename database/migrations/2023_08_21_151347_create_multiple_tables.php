<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleTables extends Migration
{
    public function up()
    {
        Schema::create('dokumen_kontraks', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kontrak');
            $table->string('nama_kegiatan_transaksi');
            $table->date('tanggal_kontrak');
            $table->decimal('jumlah_uang', 10, 2);
            $table->decimal('ppn', 10, 2)->nullable();
            $table->decimal('pph', 10, 2)->nullable();
            $table->decimal('jumlah_potongan', 10, 2)->nullable();
            $table->decimal('jumlah_total', 10, 2);
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
        
            // Add the dpa_id column
            $table->unsignedBigInteger('dpa_id');
        
            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('dokumen_pendukungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('e_purchasings', function (Blueprint $table) {
            $table->id();
            $table->string('e_commerce');
            $table->string('id_paket');
            $table->integer('jumlah');
            $table->decimal('harga_total', 10, 2);
            $table->date('tanggal_buat');
            $table->date('tanggal_ubah');
            $table->string('nama_pejabat_pengadaan');
            $table->string('nama_penyedia');
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('dokumen_justifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('basts', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('baps', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('baphs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('pilih_rekanans', function (Blueprint $table) {
            $table->id();
            $table->string('pilih')->nullable();
            $table->text('detail')->nullable();
            $table->string('jenis_pengadaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pilih_rekanans');
        Schema::dropIfExists('dokumen_kontraks');
        Schema::dropIfExists('dokumen_pendukungs');
        Schema::dropIfExists('e_purchasings');
        Schema::dropIfExists('dokumen_justifikasi');
        Schema::dropIfExists('basts');
        Schema::dropIfExists('baps');
        Schema::dropIfExists('baphs');
    }
}

