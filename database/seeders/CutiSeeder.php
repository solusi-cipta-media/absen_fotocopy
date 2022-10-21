<?php

namespace Database\Seeders;

use App\Models\Cuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cuti::create([
            'nama' => 'Cuti Tahunan',
            'waktu' => 10
        ]);
        Cuti::create([
            'nama' => 'Cuti Melahirkan',
            'waktu' => 30
        ]);
    }
}
