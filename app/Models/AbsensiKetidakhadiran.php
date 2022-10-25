<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKetidakhadiran extends Model
{
    use HasFactory;

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function cuti()
    {
        return $this->belongsTo(Cuti::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
