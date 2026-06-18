<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TenggantDokumen extends Model
{
    protected $table = 'tenggat_dokumens';

    protected $fillable = [
        'kode_dokumen',
        'nama_dokumen',
        'kategori',
        'urutan',
        'tenggat_waktu',
        'is_prasyarat',
        'prasyarat_kode',
        'hint_prasyarat',
        'is_wajib',
    ];

    protected $casts = [
        'tenggat_waktu' => 'date',
        'is_prasyarat'  => 'boolean',
        'is_wajib'      => 'boolean',
    ];

    /**
     * Accessor: sisa hari hingga tenggat (null jika tidak ada tenggat)
     */
    public function getDaysLeftAttribute(): ?int
    {
        if (!$this->tenggat_waktu) return null;
        return max(0, (int) Carbon::now()->startOfDay()->diffInDays($this->tenggat_waktu, false));
    }

    /**
     * Accessor: apakah tenggat sudah lewat
     */
    public function getIsOverdueAttribute(): bool
    {
        if (!$this->tenggat_waktu) return false;
        return Carbon::now()->startOfDay()->greaterThan($this->tenggat_waktu);
    }

    /**
     * Scope: urutkan per kategori
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('kategori')->orderBy('urutan');
    }

    /**
     * Grouping statis untuk urutan kategori
     */
    public static function kategoris(): array
    {
        return ['Surat Administrasi', 'Dokumen Akademik', 'Bimbingan', 'Output MBKM'];
    }
}
