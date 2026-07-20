<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$ujian = \App\Models\UjiKompetensi::where('jenis_ujian', 'proposal')->first();
if ($ujian) {
    echo 'Ujian ID: ' . $ujian->id . PHP_EOL;
    echo 'Pendaftaran ID: ' . $ujian->pendaftaran_mbkm_id . PHP_EOL;
    echo 'file_berkas di UjiKompetensi: ' . $ujian->file_berkas . PHP_EOL;
    
    $semuaDokumen = \App\Models\DokumenMbkm::where('pendaftaran_mbkm_id', $ujian->pendaftaran_mbkm_id)->get();
    echo 'Total Dokumen di pendaftaran ini: ' . $semuaDokumen->count() . PHP_EOL;
    foreach ($semuaDokumen as $doc) {
        echo '- ' . $doc->kode_dokumen . ' : ' . $doc->file_path . PHP_EOL;
    }
} else {
    echo 'Tidak ada data uji kompetensi proposal';
}
