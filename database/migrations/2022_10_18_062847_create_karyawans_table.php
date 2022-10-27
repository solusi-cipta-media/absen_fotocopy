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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin','supervisor', 'teknisi', 'staff']);
            $table->string('nama', 40);
            $table->string('nip', 30)->unique();
            $table->string('alamat', 255);
            $table->string('no_ktp', 30);
            $table->string('telepon', 20);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('foto');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
};
