<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'tanggal',
        'kegiatan',
        'file_bukti',
        'status_validasi',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }
}

