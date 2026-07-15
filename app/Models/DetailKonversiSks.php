<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKonversiSks extends Model
{
    protected $fillable = [
        'konversi_sks_id',
        'mata_kuliah_id',
        'nilai_diakui',
        'nilai_huruf',
    ];

    public function konversiSks()
    {
        return $this->belongsTo(KonversiSks::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}

