<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonversiSks extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'file_transkrip_mitra',
        'status',
        'status_penilaian',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }

    public function detailKonversiSks()
    {
        return $this->hasMany(DetailKonversiSks::class);
    }
}

