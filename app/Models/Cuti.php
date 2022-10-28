<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    public function absensi_ketidakhadiran()
    {
        return $this->hasMany(AbsensiKetidakhadiran::class);
    }
}
