<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'no_ktp',
        'alamat',
        'telepon',
        'jenis_kelamin',
        'foto'
    ];

    public function absensi_ketidakhadiran()
    {
        return $this->hasMany(AbsensiKetidakhadiran::class);
    }
}
