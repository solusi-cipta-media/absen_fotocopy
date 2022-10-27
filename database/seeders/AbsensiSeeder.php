<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Absensi::create([
            'karyawan_id' => 1,
            'periode_id' => 1,
            'clock_in' => '08:30:00',
            'lat_in' => '-7.8344632',
            'long_in' => '112.702065',
            'foto_in' => 'media/absensi/kehadiran/in/karyawan.jpg',
            'clock_out' => '16:30:00',
            'lat_out' => '-7.8344632',
            'long_out' => '112.702065',
            'foto_out' => 'media/absensi/kehadiran/out/karyawan.jpg',
        ]);
        Absensi::create([
            'karyawan_id' => 2,
            'periode_id' => 1,
            'clock_in' => '07:30:00',
            'lat_in' => '-7.8344632',
            'long_in' => '112.702065',
            'foto_in' => 'media/absensi/kehadiran/in/karyawan.jpg',
            'clock_out' => '15:30:00',
            'lat_out' => '-7.8344632',
            'long_out' => '112.702065',
            'foto_out' => 'media/absensi/kehadiran/out/karyawan.jpg',
        ]);
        Absensi::create([
            'karyawan_id' => 1,
            'periode_id' => 3,
            'clock_in' => '07:56:00',
            'lat_in' => '-7.8344632',
            'long_in' => '112.702065',
            'foto_in' => 'media/absensi/kehadiran/in/karyawan.jpg',
            'clock_out' => '16:05:00',
            'lat_out' => '-7.8344632',
            'long_out' => '112.702065',
            'foto_out' => 'media/absensi/kehadiran/out/karyawan.jpg',
        ]);
        Absensi::create([
            'karyawan_id' => 2,
            'periode_id' => 3,
            'clock_in' => '07:45:00',
            'lat_in' => '-7.8344632',
            'long_in' => '112.702065',
            'foto_in' => 'media/absensi/kehadiran/in/karyawan.jpg',
            'clock_out' => '13:30:00',
            'lat_out' => '-7.8344632',
            'long_out' => '112.702065',
            'foto_out' => 'media/absensi/kehadiran/out/karyawan.jpg',
        ]);
    }
}
