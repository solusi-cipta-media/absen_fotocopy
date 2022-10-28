<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function kontrak()
    {
        return $this->hasMany(Kontrak::class);
    }

    public function notifikasi()
    {
        return $this->belongsTo(Notifikasi::class);
    }
}
