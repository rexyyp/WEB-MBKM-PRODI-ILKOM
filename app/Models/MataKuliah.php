<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
    ];

    public function detailKonversiSks()
    {
        return $this->hasMany(DetailKonversiSks::class);
    }
}

