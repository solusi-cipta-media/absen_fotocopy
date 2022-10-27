<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'email',
        'password',
        'role',
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

    public function absensi()
    {
        return $this->hasMany(AbsensiKetidakhadiran::class);
    }
}
