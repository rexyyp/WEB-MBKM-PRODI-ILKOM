<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'tanggal',
        'kegiatan',
        'jam_mulai',
        'jam_selesai',
        'deskripsi',
        'file_bukti',
        'komentar_dosen',
        'status_validasi',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }
}

