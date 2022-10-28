<?php

namespace Database\Seeders;

use App\Models\AbsensiKetidakhadiran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensiKetidakhadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbsensiKetidakhadiran::create([
            'karyawan_id' => 1,
            'periode_id' =>1,
            'cuti_id' => 1,
            'bukti' => 'media/absensi/ketidakhadiran/bukti.png',
            'status' => 'approved'
        ]);
        AbsensiKetidakhadiran::create([
            'karyawan_id' => 2,
            'periode_id' =>1,
            'cuti_id' => null,
            'bukti' => 'media/absensi/ketidakhadiran/bukti.png',
            'status' => 'rejected'
        ]);
        AbsensiKetidakhadiran::create([
            'karyawan_id' => 2,
            'periode_id' =>3,
            'cuti_id' => 2,
            'bukti' => 'media/absensi/ketidakhadiran/bukti.png',
            'status' => 'waiting'
        ]);
    }
}
