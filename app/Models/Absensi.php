<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
