<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'periode_id',
        'clock_in',
        'lat_in',
        'long_in',
        'foto_in',
        'clock_out',
        'lat_out',
        'long_out',
        'foto_out',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
