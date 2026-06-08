<div id="editModal" class="fixed inset-0 backdrop-blur-md hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-96 overflow-y-auto">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold text-white" id="editModalTitle">Edit Dokumen</h3>
                <p class="text-blue-100 text-sm mt-1">Perbarui informasi dokumen atau ganti file</p>
            </div>
            <button onclick="closeEditModal()" class="text-white hover:bg-blue-500 rounded-lg p-2 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Content --}}
        <div class="p-8">
            <form class="space-y-6">
                {{-- File Input --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 uppercase mb-3">Ganti File Dokumen</label>
                    <div class="relative">
                        <input type="file" id="editFileInput" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                        <button type="button" onclick="document.getElementById('editFileInput').click()" class="w-full border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-lg py-6 px-4 text-center transition-all duration-200 hover:bg-blue-50">
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <p class="text-slate-600 font-medium">Klik untuk memilih file atau drag & drop</p>
                            <p class="text-xs text-slate-500 mt-1">PDF, DOC, XLS, PPT (Maks. 10MB)</p>
                        </button>
                        <p class="text-sm text-slate-600 mt-2" id="editFileName">File saat ini: dokumen.pdf</p>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 uppercase mb-3">Keterangan / Catatan</label>
                    <textarea placeholder="Tambahkan catatan tentang dokumen ini..." class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3"></textarea>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <div class="bg-slate-50 px-8 py-4 flex items-center justify-end gap-3 border-t border-slate-200">
            <button onclick="closeEditModal()" class="text-slate-700 hover:text-slate-900 font-semibold py-2 px-6 transition-all duration-200">
                Batal
            </button>
            <button onclick="saveEditChanges()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<script>
function openEditModal(docName, fileName) {
    document.getElementById('editModalTitle').textContent = `Edit ${docName}`;
    document.getElementById('editFileName').textContent = `File saat ini: ${fileName}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function saveEditChanges() {
    alert('Perubahan disimpan! (Demo)');
    closeEditModal();
}

document.getElementById('editFileInput')?.addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'dokumen.pdf';
    const fileSize = (e.target.files[0]?.size / 1024).toFixed(0) + ' KB';
    document.getElementById('editFileName').textContent = `File dipilih: ${fileName} (${fileSize})`;
});

// Close modal when clicking outside
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>
