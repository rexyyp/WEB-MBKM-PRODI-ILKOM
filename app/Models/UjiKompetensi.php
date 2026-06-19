<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjiKompetensi extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_ujian',
        'tipe_ujian',
        'link_daring',
        'tgl_ujian',
        'nilai',
        'file_berkas',
        'catatan_revisi',
        'diajukan_at',
        'dosen_penguji_id',
        'status',
    ];

    protected $casts = [
        'diajukan_at' => 'datetime',
        'tgl_ujian' => 'date',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }

    public function dosenPenguji()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_id');
    }

    public function scopeProposal($query)
    {
        return $query->where('jenis_ujian', 'proposal');
    }

    public function scopeLaporanAkhir($query)
    {
        return $query->where('jenis_ujian', 'laporan_akhir');
    }

    public function scopeUntukMahasiswa($query, $pendaftaranId)
    {
        return $query->where('pendaftaran_mbkm_id', $pendaftaranId);
    }
}
