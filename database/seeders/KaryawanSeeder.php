<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Karyawan;

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
            'nama' => 'Asep sukirman',
            'nip' => '9123412489',
            'alamat' => 'Jalan Ahmad Yani, No1. Jonggol, Indonesia',
            'no_ktp' => '3561000012933',
            'telepon' => '089123123123',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'media/avatars/asa.jpg'
        ]);

        Karyawan::create([
            'nama' => 'Joko Sembung',
            'nip' => '9123412481',
            'alamat' => 'Jalan Ahmad Yani, No2. Jonggol, Indonesia',
            'no_ktp' => '3561000012912',
            'telepon' => '089123123190',
            'jenis_kelamin' => 'laki-laki',
            'foto' => 'media/avatars/asa.jpg'
        ]);

    }
}
