<?php

namespace Database\Seeders;

use App\Models\Kontrak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KontrakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kontrak::create([
            'customer_id' => 1,
            'nomor' => '12309',
            'awal' => Carbon::now()->subDays(3),
            'akhir' => Carbon::now()->addDays(20),
            'reminder' => Carbon::now()->subDays(2),
            'pdf' => 'media/kontrak/sample.pdf'
        ]);
        Kontrak::create([
            'customer_id' => 2,
            'nomor' => '12332',
            'awal' => Carbon::now()->subDays(30),
            'akhir' => Carbon::now()->addDays(30),
            'reminder' => Carbon::now()->subDay(),
            'pdf' => 'media/kontrak/sample.pdf'
        ]);
        Kontrak::create([
            'customer_id' => 3,
            'nomor' => '12312',
            'awal' => Carbon::now()->subDays(40),
            'akhir' => Carbon::now()->addDays(10),
            'reminder' => Carbon::now(),
            'pdf' => 'media/kontrak/sample.pdf'
        ]);
    }
}
