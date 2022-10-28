<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('periode_id')->references('id')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->time('clock_in');
            $table->string('lat_in');
            $table->string('long_in');
            $table->string('foto_in');
            $table->time('clock_out');
            $table->string('lat_out');
            $table->string('long_out');
            $table->string('foto_out');
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
        Schema::dropIfExists('absensis');
    }
};
