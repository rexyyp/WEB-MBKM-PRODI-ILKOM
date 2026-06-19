<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'tanggal',
        'topik',
        'tipe',
        'jam',
        'link_meeting',
        'catatan_mahasiswa',
        'catatan_dosen',
        'status',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }
}

