<div id="uploadModal" class="fixed inset-0 backdrop-blur-md hidden items-center justify-center z-50 p-4" style="display:none!important">
</div>

{{-- Trigger: diset via JS, form submit ke route upload --}}
<form id="uploadForm"
      method="POST"
      action="{{ route('mahasiswa.dokumen.upload') }}"
      enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="kode_dokumen" id="uploadKodeDokumen">
</form>

<div id="uploadModalOverlay"
     class="fixed inset-0 backdrop-blur-sm bg-black/30 hidden items-center justify-center z-50 p-4"
     onclick="if(event.target===this) closeUploadModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl" onclick="event.stopPropagation()">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 rounded-t-2xl flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-white" id="uploadModalTitle">Upload Dokumen</h3>
                <p class="text-blue-100 text-sm mt-0.5" id="uploadModalSubtitle">Pilih file dokumen untuk diunggah</p>
            </div>
            <button type="button" onclick="closeUploadModal()" class="text-white hover:bg-blue-500 rounded-lg p-2 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Content --}}
        <div class="p-6">
            {{-- Validation errors --}}
            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg px-4 py-3">
                    <ul class="text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Drop Zone --}}
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pilih File</label>
                <div id="uploadDropZone"
                     class="border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-xl py-10 px-6 text-center transition-all duration-200 hover:bg-blue-50 cursor-pointer"
                     onclick="document.getElementById('uploadFileInput').click()">
                    <svg class="w-10 h-10 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-7"/>
                    </svg>
                    <p class="text-slate-800 font-semibold mb-1">Drag & drop file di sini</p>
                    <p class="text-slate-500 text-sm mb-4">atau klik untuk memilih file</p>
                    <input type="file"
                           id="uploadFileInput"
                           name="file"
                           form="uploadForm"
                           class="hidden"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.png,.jpeg">
                    <span class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-5 rounded-lg inline-block transition-colors">
                        Pilih File dari Device
                    </span>
                    <p class="text-xs text-slate-400 mt-3">PDF, DOC, XLS, PPT, JPG, PNG — Maks. 10MB</p>
                </div>
                <p class="text-sm text-slate-500 mt-2" id="uploadFileName">Belum ada file dipilih</p>
            </div>

            {{-- Progress Bar (saat submit) --}}
            <div id="uploadProgress" class="hidden mt-4">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mengunggah...</p>
                <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                    <div id="uploadProgressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-300 animate-pulse" style="width: 80%"></div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 rounded-b-2xl border-t border-slate-100">
            <button type="button" onclick="closeUploadModal()" class="text-slate-600 hover:text-slate-900 font-semibold py-2 px-5 text-sm transition-colors">
                Batal
            </button>
            <button type="button" onclick="submitUploadReal()"
                    id="uploadSubmitBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg text-sm transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Upload Dokumen
            </button>
        </div>
    </div>
</div>

<script>
function openUploadModal(kode, nama) {
    document.getElementById('uploadModalTitle').textContent = 'Upload ' + nama;
    document.getElementById('uploadModalSubtitle').textContent = 'Pilih file untuk: ' + nama;
    document.getElementById('uploadKodeDokumen').value = kode;
    document.getElementById('uploadFileName').textContent = 'Belum ada file dipilih';
    document.getElementById('uploadFileInput').value = '';
    document.getElementById('uploadProgress').classList.add('hidden');
    const overlay = document.getElementById('uploadModalOverlay');
    overlay.classList.remove('hidden');
    overlay.style.display = 'flex';
}

function closeUploadModal() {
    const overlay = document.getElementById('uploadModalOverlay');
    overlay.classList.add('hidden');
    overlay.style.display = 'none';
}

function submitUploadReal() {
    const fileInput = document.getElementById('uploadFileInput');
    if (!fileInput.files.length) {
        alert('Silakan pilih file terlebih dahulu.');
        return;
    }
    document.getElementById('uploadProgress').classList.remove('hidden');
    document.getElementById('uploadSubmitBtn').disabled = true;
    document.getElementById('uploadSubmitBtn').textContent = 'Mengunggah...';
    document.getElementById('uploadForm').submit();
}

// Drag & drop
const dropZone = document.getElementById('uploadDropZone');
const fileInput = document.getElementById('uploadFileInput');

if (dropZone) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => {
        dropZone.addEventListener(e, ev => { ev.preventDefault(); ev.stopPropagation(); }, false);
    });
    ['dragenter', 'dragover'].forEach(e => {
        dropZone.addEventListener(e, () => dropZone.classList.add('border-blue-500', 'bg-blue-50'));
    });
    ['dragleave', 'drop'].forEach(e => {
        dropZone.addEventListener(e, () => dropZone.classList.remove('border-blue-500', 'bg-blue-50'));
    });
    dropZone.addEventListener('drop', (e) => {
        fileInput.files = e.dataTransfer.files;
        updateFileName();
    });
}

fileInput?.addEventListener('change', updateFileName);

function updateFileName() {
    const file = fileInput.files[0];
    if (file) {
        const size = file.size >= 1048576
            ? (file.size / 1048576).toFixed(2) + ' MB'
            : Math.round(file.size / 1024) + ' KB';
        document.getElementById('uploadFileName').textContent = `File dipilih: ${file.name} (${size})`;
    }
}

// Buka modal otomatis jika ada error validasi
@if($errors->any())
    document.addEventListener('DOMContentLoaded', () => {
        const kode = '{{ old('kode_dokumen') }}';
        if (kode) openUploadModal(kode, kode.replace(/_/g, ' '));
    });
@endif
</script>
