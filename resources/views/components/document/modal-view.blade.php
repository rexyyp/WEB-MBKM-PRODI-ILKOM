<div id="viewModal" class="fixed inset-0 backdrop-blur-md hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-96 overflow-y-auto">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold text-white" id="viewModalTitle">Lihat Dokumen</h3>
                <p class="text-blue-100 text-sm mt-1">Preview dokumen yang telah diunggah</p>
            </div>
            <button onclick="closeViewModal()" class="text-white hover:bg-blue-500 rounded-lg p-2 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Content --}}
        <div class="p-8">
            <div class="space-y-4">
                {{-- Document Info --}}
                <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                    <p class="text-xs font-semibold text-slate-600 uppercase mb-2">Nama File</p>
                    <p class="text-lg font-semibold text-slate-900" id="viewModalFileName">dokumen.pdf</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <p class="text-xs font-semibold text-slate-600 uppercase mb-2">Ukuran File</p>
                        <p class="text-lg font-semibold text-slate-900" id="viewModalFileSize">245 KB</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <p class="text-xs font-semibold text-slate-600 uppercase mb-2">Tanggal Upload</p>
                        <p class="text-lg font-semibold text-slate-900" id="viewModalUploadDate">15 Mei 2024</p>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="bg-slate-100 rounded-lg p-6 min-h-48 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-slate-600 font-medium">Preview dokumen PDF</p>
                        <p class="text-sm text-slate-500 mt-1">Klik tombol Download untuk membuka dokumen</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="bg-slate-50 px-8 py-4 flex items-center justify-end gap-3 border-t border-slate-200">
            <button onclick="closeViewModal()" class="text-slate-700 hover:text-slate-900 font-semibold py-2 px-6 transition-all duration-200">
                Tutup
            </button>
            <a href="#" id="viewModalDownloadBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download
            </a>
        </div>
    </div>
</div>

<script>
function openViewModal(docName, fileName, fileSize) {
    document.getElementById('viewModalTitle').textContent = docName;
    document.getElementById('viewModalFileName').textContent = fileName;
    document.getElementById('viewModalFileSize').textContent = fileSize;
    document.getElementById('viewModalUploadDate').textContent = new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    document.getElementById('viewModal').classList.remove('hidden');
}

function closeViewModal() {
    document.getElementById('viewModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('viewModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeViewModal();
});
</script>
