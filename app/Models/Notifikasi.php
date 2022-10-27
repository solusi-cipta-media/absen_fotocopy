<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kontrak_id',
        'pesan',
        'tanggal'
    ];

    public function kontrak()
    {
        return $this->hasOne(Kontrak::class);
    }

    public function customer()
    {
        return $this->hasOneThrough(Kontrak::class, Customer::class);
    }
}
