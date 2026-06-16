<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'jenis_dosen',
        'no_telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaranMbkmSebagaiPembimbing()
    {
        return $this->hasMany(PendaftaranMbkm::class, 'dosen_pembimbing_id');
    }

    public function pendaftaranMbkmSebagaiPenguji()
    {
        return $this->hasMany(PendaftaranMbkm::class, 'dosen_penguji_id');
    }
}

