<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'nim',
        'prodi',
        'angkatan',
        'no_telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaranMbkm()
    {
        return $this->hasMany(PendaftaranMbkm::class);
    }
}

