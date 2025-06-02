<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JanjiPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jadwal_periksa',
        'id_pasien',
        'keluhan',
        'no_antrian',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa');
    }
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }
}
