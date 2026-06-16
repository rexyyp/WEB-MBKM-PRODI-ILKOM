<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraMbkm extends Model
{
    protected $fillable = [
        'nama_mitra',
        'alamat',
        'lokasi',
        'narahubung',
        'no_telp_narahubung',
    ];

    public function pendaftaranMbkm()
    {
        return $this->hasMany(PendaftaranMbkm::class);
    }
}

