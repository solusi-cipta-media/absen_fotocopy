<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::create([
            'tanggal' => Carbon::now()->subDays(2),
            'status' => 'aktif',
            'clock_in' => '08:00:00',
            'clock_out' => '16:00:00'
        ]);
        Periode::create([
            'tanggal' => Carbon::now()->subDays(1),
            'status' => 'libur'
        ]);
        Periode::create([
            'tanggal' => Carbon::now(),
            'status' => 'aktif',
            'clock_in' => '08:00:00',
            'clock_out' => '16:00:00'
        ]);
    }
}
