<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Karyawan::create([
            'email' => 'karyawan1@gmail.com',
            'password' => Hash::make('secret'),
            'role' => 'admin',
            'nama' => 'Asep sukirman',
            'nip' => '9123412489',
            'alamat' => 'Jalan Ahmad Yani, No1. Jonggol, Indonesia',
            'no_ktp' => '3561000012933',
            'telepon' => '089123123123',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'media/karyawan/karyawan.jpg'
        ]);

        Karyawan::create([
            'email' => 'karyawan2@gmail.com',
            'password' => Hash::make('secret'),
            'role' => 'supervisor',
            'nama' => 'Joko Sembung',
            'nip' => '9123412481',
            'alamat' => 'Jalan Ahmad Yani, No2. Jonggol, Indonesia',
            'no_ktp' => '3561000012912',
            'telepon' => '089123123190',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'media/karyawan/karyawan.jpg'
        ]);

        Karyawan::create([
            'email' => 'karyawan3@gmail.com',
            'password' => Hash::make('secret'),
            'role' => 'staff',
            'nama' => 'Ani sunandar',
            'nip' => '9123412412',
            'alamat' => 'Jalan Ahmad Yani, No2. Jonggol, Indonesia',
            'no_ktp' => '3561000012951',
            'telepon' => '089123123120',
            'jenis_kelamin' => 'perempuan',
            'foto' => 'media/karyawan/karyawan.jpg'
        ]);

        Karyawan::create([
            'email' => 'karyawan4@gmail.com',
            'password' => Hash::make('secret'),
            'role' => 'staff',
            'nama' => 'Rahmad Wiyoto',
            'nip' => '9123512412',
            'alamat' => 'Jalan Ahmad Yani, No2. Jonggol, Indonesia',
            'no_ktp' => '35610001232951',
            'telepon' => '089123123120',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'media/karyawan/karyawan.jpg'
        ]);
    }
}
