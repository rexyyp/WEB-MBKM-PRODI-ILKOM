import os
import re

models_dir = "app/Models"
files = os.listdir(models_dir)

model_contents = {
    'User': """    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];""",

    'Mahasiswa': """    protected $fillable = [
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
    }""",

    'Dosen': """    protected $fillable = [
        'user_id',
        'nip',
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
    }""",

    'MitraMbkm': """    protected $fillable = [
        'nama_mitra',
        'bidang_usaha',
        'alamat',
        'narahubung',
        'no_telp_narahubung',
    ];

    public function pendaftaranMbkm()
    {
        return $this->hasMany(PendaftaranMbkm::class);
    }""",

    'ProgramMbkm': """    protected $fillable = [
        'nama_program',
        'deskripsi',
    ];

    public function pendaftaranMbkm()
    {
        return $this->hasMany(PendaftaranMbkm::class);
    }""",

    'MataKuliah': """    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
    ];

    public function detailKonversiSks()
    {
        return $this->hasMany(DetailKonversiSks::class);
    }""",

    'PendaftaranMbkm': """    protected $fillable = [
        'mahasiswa_id',
        'mitra_mbkm_id',
        'program_mbkm_id',
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
    }""",

    'Logbook': """    protected $fillable = [
        'pendaftaran_mbkm_id',
        'tanggal',
        'kegiatan',
        'file_bukti',
        'status_validasi',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }""",

    'Bimbingan': """    protected $fillable = [
        'pendaftaran_mbkm_id',
        'tanggal',
        'catatan_mahasiswa',
        'catatan_dosen',
        'status',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }""",

    'DokumenMbkm': """    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_dokumen',
        'file_path',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }""",

    'UjiKompetensi': """    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_ujian',
        'tgl_ujian',
        'nilai',
        'file_berkas',
        'status',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }""",

    'KonversiSks': """    protected $fillable = [
        'pendaftaran_mbkm_id',
        'file_transkrip_mitra',
        'status',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }

    public function detailKonversiSks()
    {
        return $this->hasMany(DetailKonversiSks::class);
    }""",

    'DetailKonversiSks': """    protected $fillable = [
        'konversi_sks_id',
        'mata_kuliah_id',
        'nilai_diakui',
    ];

    public function konversiSks()
    {
        return $this->belongsTo(KonversiSks::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }""",

    'Penilaian': """    protected $fillable = [
        'pendaftaran_mbkm_id',
        'jenis_penilai',
        'nilai_total',
        'catatan',
    ];

    public function pendaftaranMbkm()
    {
        return $this->belongsTo(PendaftaranMbkm::class);
    }"""
}

for file in files:
    if file.endswith('.php'):
        model_name = file[:-4]
        if model_name in model_contents:
            path = os.path.join(models_dir, file)
            with open(path, 'r') as f:
                content = f.read()

            if model_name == 'User':
                # Replace the $fillable array
                content = re.sub(r'protected \$fillable = \[.*?\];', model_contents['User'], content, flags=re.DOTALL)
                
                # Append relationships just before the last '}'
                if 'public function mahasiswa()' not in content:
                    relationships = """
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }
}"""
                    content = re.sub(r'\}$', relationships, content)
            else:
                has_factory = 'use HasFactory;' in content
                
                new_body = "class " + model_name + " extends Model\n{\n"
                if has_factory:
                    new_body += "    use HasFactory;\n\n"
                new_body += model_contents[model_name] + "\n}\n"
                
                content = re.sub(r'class ' + model_name + r' extends Model\n\{.*?\}', new_body, content, flags=re.DOTALL)

            with open(path, 'w') as f:
                f.write(content)
            print(f"Updated {model_name}")
