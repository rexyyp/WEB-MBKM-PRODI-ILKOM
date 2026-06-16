<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranMbkm extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'mitra_mbkm_id',
        'program_mbkm_id',
        'posisi_magang',
        'detail_pekerjaan',
        'dosen_pembimbing_id',
        'dosen_penguji_id',
        'status',
        'tgl_mulai',
        'tgl_selesai',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mitraMbkm()
    {
        return $this->belongsTo(MitraMbkm::class);
    }

    public function programMbkm()
    {
        return $this->belongsTo(ProgramMbkm::class);
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }

    public function dosenPenguji()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class);
    }

    public function dokumenMbkms()
    {
        return $this->hasMany(DokumenMbkm::class);
    }

    public function ujiKompetensis()
    {
        return $this->hasMany(UjiKompetensi::class);
    }

    public function konversiSks()
    {
        return $this->hasOne(KonversiSks::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}

