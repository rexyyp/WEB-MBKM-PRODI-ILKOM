<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenMbkm extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_dokumen',
        'file_path',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }
}

