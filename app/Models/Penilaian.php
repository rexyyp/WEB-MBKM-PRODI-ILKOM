<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_penilai',
        'nilai_total',
        'catatan',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }
}

