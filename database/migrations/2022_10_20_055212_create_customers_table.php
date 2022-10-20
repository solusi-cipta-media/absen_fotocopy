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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 40)->unique();
            $table->string('nama', 40);
            $table->string('alamat', 255);
            $table->string('latitude',20);
            $table->string('longitude',20);
            $table->enum('klasifikasi',['rental', 'kontrak', 'beli']);
            $table->string('kontak_nama',40);
            $table->string('kontak_telepon',20);
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
        Schema::dropIfExists('customers');
    }
};
