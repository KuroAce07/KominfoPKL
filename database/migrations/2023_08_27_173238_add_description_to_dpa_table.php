<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToDpaTable extends Migration
{
    public function up()
    {
        Schema::table('dpa', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('dpa', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
