<div id="uploadModal" class="fixed inset-0 backdrop-blur-md hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-96 overflow-y-auto">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold text-white" id="uploadModalTitle">Upload Dokumen</h3>
                <p class="text-blue-100 text-sm mt-1" id="uploadModalSubtitle">Pilih file dokumen untuk diunggah</p>
            </div>
            <button onclick="closeUploadModal()" class="text-white hover:bg-blue-500 rounded-lg p-2 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Content --}}
        <div class="p-8">
            <form id="uploadForm" class="space-y-6">
                {{-- File Drop Zone --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 uppercase mb-3">Pilih File</label>
                    <div id="uploadDropZone" class="border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-xl py-8 px-6 text-center transition-all duration-200 hover:bg-blue-50 cursor-pointer">
                        <svg class="w-12 h-12 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-7"></path>
                        </svg>
                        <p class="text-slate-900 font-semibold text-lg mb-1">Drag & drop file di sini</p>
                        <p class="text-slate-600 mb-4">atau</p>
                        <input type="file" id="uploadFileInput" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.png,.jpeg">
                        <button type="button" onclick="document.getElementById('uploadFileInput').click()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 inline-block">
                            Pilih File dari Device
                        </button>
                        <p class="text-xs text-slate-500 mt-3">Tipe file: PDF, DOC, XLS, PPT, JPG, PNG (Maks. 10MB)</p>
                    </div>
                    <p class="text-sm text-slate-600 mt-3" id="uploadFileName">Belum ada file dipilih</p>
                </div>

                {{-- Progress Bar (hidden initially) --}}
                <div id="uploadProgress" class="hidden">
                    <p class="text-sm font-semibold text-slate-700 uppercase mb-2">Progress Upload</p>
                    <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                        <div id="uploadProgressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-slate-600 mt-2"><span id="uploadPercentage">0</span>% selesai</p>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <div class="bg-slate-50 px-8 py-4 flex items-center justify-end gap-3 border-t border-slate-200">
            <button onclick="closeUploadModal()" class="text-slate-700 hover:text-slate-900 font-semibold py-2 px-6 transition-all duration-200">
                Batal
            </button>
            <button onclick="submitUpload()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Upload Dokumen
            </button>
        </div>
    </div>
</div>

<script>
function openUploadModal(documentName = 'Dokumen') {
    document.getElementById('uploadModalTitle').textContent = `Upload ${documentName}`;
    document.getElementById('uploadModalSubtitle').textContent = `Pilih file untuk ${documentName}`;
    document.getElementById('uploadModal').classList.remove('hidden');
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.getElementById('uploadFileName').textContent = 'Belum ada file dipilih';
    document.getElementById('uploadProgress').classList.add('hidden');
    document.getElementById('uploadFileInput').value = '';
}

function submitUpload() {
    const fileInput = document.getElementById('uploadFileInput');
    if (!fileInput.files.length) {
        alert('Silakan pilih file terlebih dahulu');
        return;
    }

    // Simulate upload progress
    document.getElementById('uploadProgress').classList.remove('hidden');
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 30;
        if (progress > 100) progress = 100;
        document.getElementById('uploadProgressBar').style.width = progress + '%';
        document.getElementById('uploadPercentage').textContent = Math.round(progress);
        
        if (progress === 100) {
            clearInterval(interval);
            setTimeout(() => {
                alert('File berhasil diunggah!');
                closeUploadModal();
            }, 500);
        }
    }, 300);
}

const dropZone = document.getElementById('uploadDropZone');
const fileInput = document.getElementById('uploadFileInput');

if (dropZone) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        });
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
        const size = (file.size / 1024).toFixed(2);
        document.getElementById('uploadFileName').textContent = `File dipilih: ${file.name} (${size} KB)`;
    }
}

// Close modal when clicking outside
document.getElementById('uploadModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeUploadModal();
});
</script>
