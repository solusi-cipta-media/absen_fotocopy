<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'kode' => 'A0903',
            'nama' => 'PT. Pertamina',
            'alamat' => 'Jalan Ahmad Yani, Jakarta',
            'latitude' => '-7.8344632',
            'longitude' => '112.702065',
            'klasifikasi' => 'rental',
            'kontak_nama' => 'Asep',
            'kontak_telepon' => '08267371752'
        ]);
        Customer::create([
            'kode' => 'A0904',
            'nama' => 'PT. Jaya Abadi',
            'alamat' => 'Jalan Angsa Emas, Jakarta',
            'latitude' => '-7.8344662',
            'longitude' => '112.802065',
            'klasifikasi' => 'kontrak',
            'kontak_nama' => 'Asep',
            'kontak_telepon' => '08267371752'
        ]);
        Customer::create([
            'kode' => 'A0905',
            'nama' => 'PT. Dua Permata',
            'alamat' => 'Jalan Ayam Potong, Jakarta',
            'latitude' => '-8.8344632',
            'longitude' => '102.702065',
            'klasifikasi' => 'beli',
            'kontak_nama' => 'Asep',
            'kontak_telepon' => '08267371752'
        ]);
    }
}
