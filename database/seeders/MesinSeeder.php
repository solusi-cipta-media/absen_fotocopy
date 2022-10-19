<?php

namespace Database\Seeders;

use App\Models\Mesin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MesinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mesin::create([
            'nomor' => '4120934',
            'serial' => 'sn124123',
            'model' => 'b90qw',
            'asal' => 'import',
            'meter' => 2000,
            'tegangan' => '220v',
            'status' => 'import'
        ]);
        Mesin::create([
            'nomor' => '4120932',
            'serial' => 'sn124121',
            'model' => 'b90qw',
            'asal' => 'import',
            'meter' => 0,
            'tegangan' => '220v',
            'status' => 'import'
        ]);

        Mesin::create([
            'nomor' => '4220934',
            'serial' => 'sn224123',
            'model' => 'p12',
            'asal' => 'ex-customer',
            'meter' => 2000,
            'tegangan' => '110v',
            'status' => 'ready'
        ]);
        Mesin::create([
            'nomor' => '4220932',
            'serial' => 'sn224121',
            'model' => 'p12',
            'asal' => 'ex-customer',
            'meter' => 0,
            'tegangan' => '110v',
            'status' => 'overhaul'
        ]);
    }
}
