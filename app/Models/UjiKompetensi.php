<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjiKompetensi extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_ujian',
        'tgl_ujian',
        'nilai',
        'file_berkas',
        'status',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }
}

