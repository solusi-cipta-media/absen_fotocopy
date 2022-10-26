<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
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
}
