<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenMbkm extends Model
{
    protected $fillable = [
        'pendaftaran_mbkm_id',
        'kode_dokumen',
        'file_path',
        'file_name',
        'file_size',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }

    public function tenggat()
    {
        return $this->belongsTo(TenggantDokumen::class, 'kode_dokumen', 'kode_dokumen');
    }

    /**
     * Accessor: ukuran file dalam format human-readable (KB / MB)
     */
    public function getFileSizeHumanAttribute(): string
    {
        if (!$this->file_size) return '-';
        if ($this->file_size >= 1048576) {
            return round($this->file_size / 1048576, 2) . ' MB';
        }
        return round($this->file_size / 1024, 0) . ' KB';
    }
}
