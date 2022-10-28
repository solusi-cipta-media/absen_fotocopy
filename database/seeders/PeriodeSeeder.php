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
            'status' => 'aktif'
        ]);
        Periode::create([
            'tanggal' => Carbon::now()->subDays(1),
            'status' => 'libur'
        ]);
        Periode::create([
            'tanggal' => Carbon::now(),
            'status' => 'aktif'
        ]);
    }
}
