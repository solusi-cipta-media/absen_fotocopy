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
        Schema::create('absensi_ketidakhadirans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('cuti_id')->nullable();
            $table->foreign('cuti_id')->references('id')->on('cutis')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bukti')->nullable();
            $table->enum('status', ['waiting', 'approved', 'rejected']);
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
        Schema::dropIfExists('absensi_ketidakhadirans');
    }
};
