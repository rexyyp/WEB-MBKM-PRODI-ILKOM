<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMbkm extends Model
{
    protected $fillable = [
        'nama_program',
        'deskripsi',
    ];

    public function pendaftaranMbkm()
    {
        return $this->hasMany(PendaftaranMbkm::class);
    }
}

