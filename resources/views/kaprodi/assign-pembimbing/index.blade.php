@extends('layouts.kaprodi')

@section('title', 'Assign Pembimbing & Penguji - Kaprodi Panel')

@section('content')
<div x-data="{ 
        showModal: false, 
        studentName: '', 
        studentNim: '', 
        studentMitra: '' 
    }">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Assign Pembimbing & Penguji</h1>
        <p class="text-slate-500 text-lg">Tentukan dosen pembimbing dan penguji untuk mahasiswa MBKM guna memastikan kualitas bimbingan akademik yang optimal.</p>
    </div>

    {{-- Main Content Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Action Bar --}}
        <div class="p-6 border-b border-slate-100 bg-white">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama atau NIM mahasiswa...">
                </div>

                {{-- Filters --}}
                <div class="flex items-center gap-3 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                    <div class="relative w-44 flex-shrink-0">
                        <select class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                            <option>Semua Status</option>
                            <option>Belum assign</option>
                            <option>Sudah assign</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            NIM & Nama Mahasiswa
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Mitra MBKM
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Pembimbing
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Penguji
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    {{-- Row 1: Sudah Ditentukan --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">2108561001</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">Arya Satria</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-800">Gojek - Product Management</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-semibold text-slate-700">Dr. Eng. I Made Smith, M.T.</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-semibold text-slate-700">Prof. Wayan Doe, Ph.D.</span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-green-100 text-green-700 tracking-wide">
                                SUDAH DITENTUKAN
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button 
                                @click="showModal = true; studentName = 'Arya Satria'; studentNim = '2108561001'; studentMitra = 'Gojek - Product Management'"
                                class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors gap-1.5">
                                Ubah
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </td>
                    </tr>

                    {{-- Row 2: Belum Ditentukan --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">2108561022</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">Dian Permata</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-800">Telkom Indonesia - UI/UX</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-400">Belum ditentukan</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-400">Belum ditentukan</span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-red-50 text-red-600 tracking-wide">
                                BELUM DITENTUKAN
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button 
                                @click="showModal = true; studentName = 'Dian Permata'; studentNim = '2108561022'; studentMitra = 'Telkom Indonesia - UI/UX'"
                                class="inline-flex items-center px-5 py-2 rounded-lg text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                                Assign
                            </button>
                        </td>
                    </tr>

                    {{-- Row 3: Sudah Ditentukan --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">2108561045</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">Rizky Wijaya</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-800">BCA - Software Engineering</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-semibold text-slate-700">Gede Putra, M.Cs.</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-semibold text-slate-700">Dr. Rani, M.Kom.</span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-green-100 text-green-700 tracking-wide">
                                SUDAH DITENTUKAN
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button 
                                @click="showModal = true; studentName = 'Rizky Wijaya'; studentNim = '2108561045'; studentMitra = 'BCA - Software Engineering'"
                                class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors gap-1.5">
                                Ubah
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </td>
                    </tr>

                    {{-- Row 4: Belum Ditentukan --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">2108561088</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">Maya Kusuma</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-800">Traveloka - Data Science</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-400">Belum ditentukan</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-400">Belum ditentukan</span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-red-50 text-red-600 tracking-wide">
                                BELUM DITENTUKAN
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button 
                                @click="showModal = true; studentName = 'Maya Kusuma'; studentNim = '2108561088'; studentMitra = 'Traveloka - Data Science'"
                                class="inline-flex items-center px-5 py-2 rounded-lg text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                                Assign
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-slate-50">
            <p class="text-sm text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-700">1</span> sampai <span class="font-bold text-slate-700">4</span> dari <span class="font-bold text-slate-700">24</span> hasil</p>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-medium text-slate-400 bg-white cursor-not-allowed">Sebelah</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-white bg-blue-600 shadow-sm">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-white bg-white transition-colors">2</button>
                <span class="text-slate-400 px-1">...</span>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-white bg-white transition-colors">5</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-white bg-white transition-colors">Selanjutnya</button>
            </div>
        </div>
    </div>

    {{-- Modal Assign Dosen --}}
    <div 
        x-show="showModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" 
        role="dialog" 
        aria-modal="true"
    >
        {{-- Backdrop --}}
        <div 
            x-show="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" 
            @click="showModal = false"
        ></div>

        {{-- Modal Panel --}}
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div 
                x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
            >
                {{-- Modal Header --}}
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-800" id="modal-title">
                        Tentukan Dosen Pembimbing & Penguji
                    </h3>
                    <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form action="#" method="POST">
                    @csrf
                    <div class="px-6 py-5">
                        {{-- Informasi Konteks --}}
                        <div class="bg-slate-50 rounded-lg p-4 mb-6 border border-slate-100">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Data Mahasiswa</p>
                            <div class="flex flex-col gap-1">
                                <p class="text-sm font-bold text-slate-900" x-text="studentName + ' (' + studentNim + ')'"></p>
                                <p class="text-sm font-medium text-slate-600 flex items-center gap-1.5 mt-1">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span x-text="studentMitra"></span>
                                </p>
                            </div>
                        </div>

                        {{-- Form Inputs --}}
                        <div class="space-y-5">
                            {{-- Pilih Pembimbing --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Dosen Pembimbing</label>
                                <div class="relative">
                                    <select class="block w-full pl-4 pr-10 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm font-medium text-slate-700 appearance-none bg-white">
                                        <option value="" disabled selected>Ketik untuk mencari nama dosen...</option>
                                        <option value="1">Dr. Eng. I Made Smith, M.T.</option>
                                        <option value="2">Gede Putra, M.Cs.</option>
                                        <option value="3">Ir. Budi Santoso, M.Kom.</option>
                                        <option value="4">Dr. Siti Aminah, S.T., M.T.</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Pilih Penguji --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Dosen Penguji</label>
                                <div class="relative">
                                    <select class="block w-full pl-4 pr-10 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm font-medium text-slate-700 appearance-none bg-white">
                                        <option value="" disabled selected>Ketik untuk mencari nama dosen...</option>
                                        <option value="1">Prof. Wayan Doe, Ph.D.</option>
                                        <option value="2">Dr. Rani, M.Kom.</option>
                                        <option value="3">Dr. Andi Wijaya, M.Sc.</option>
                                        <option value="4">Ir. Agus Pratama, M.Eng.</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-end gap-3 rounded-b-2xl">
                        <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-lg text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-lg text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
