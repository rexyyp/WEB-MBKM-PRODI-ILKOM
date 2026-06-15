@extends('layouts.kaprodi')

@section('title', 'Laporan MBKM - Kaprodi Panel')

@section('content')
    {{-- Header Area with Export Buttons --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Laporan MBKM</h1>
            </div>
            <p class="text-slate-600 text-lg">Rekap dan export data kegiatan MBKM mahasiswa</p>
        </div>
        <div class="flex items-center gap-3">
            {{-- Button Export PDF --}}
            <button class="inline-flex items-center px-5 py-2.5 rounded-lg text-sm font-bold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 transition-colors shadow-sm gap-2">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Export PDF
            </button>
            {{-- Button Export Excel --}}
            <button class="inline-flex items-center px-5 py-2.5 rounded-lg text-sm font-bold text-white bg-blue-700 hover:bg-blue-800 transition-colors shadow-sm gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </button>
        </div>
    </div>

    {{-- Top Cards (3 Cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Mahasiswa --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-2">
                <h3 class="text-sm font-bold text-slate-700">Total Mahasiswa</h3>
                <div class="text-slate-300 group-hover:text-blue-500 transition-colors">
                    {{-- Toga / Graduation Cap Icon --}}
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14v7"></path></svg>
                </div>
            </div>
            <div>
                <span class="text-4xl font-extrabold text-blue-700 tracking-tight">1,245</span>
                <p class="text-[11px] font-semibold text-slate-400 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +12% dari semester lalu
                </p>
            </div>
        </div>

        {{-- Rata-rata Nilai --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-2">
                <h3 class="text-sm font-bold text-slate-700">Rata-rata Nilai</h3>
                <div class="text-slate-300 group-hover:text-yellow-400 transition-colors">
                    {{-- Star Icon --}}
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
            </div>
            <div>
                <span class="text-4xl font-extrabold text-blue-700 tracking-tight">3.85</span>
                <p class="text-[11px] font-semibold text-slate-400 mt-2">
                    Skala 4.00
                </p>
            </div>
        </div>

        {{-- Total SKS Terkonversi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-2">
                <h3 class="text-sm font-bold text-slate-700">Total SKS Terkonversi</h3>
                <div class="text-slate-300 group-hover:text-blue-500 transition-colors">
                    {{-- Documents Icon --}}
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                </div>
            </div>
            <div>
                <span class="text-4xl font-extrabold text-blue-700 tracking-tight">24,500</span>
                <p class="text-[11px] font-semibold text-slate-400 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tersebar di 45 Mitra
                </p>
            </div>
        </div>
    </div>

    {{-- Main Content Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        
        {{-- Filter Data Laporan Container --}}
        <div class="bg-slate-50 p-6 border-b border-slate-100">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                <h3 class="text-sm font-bold text-slate-700">Filter Data Laporan</h3>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Status MBKM --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5">Status MBKM</label>
                    <div class="relative">
                        <select class="block w-full pl-3 pr-10 py-2 border border-slate-200 rounded-lg leading-5 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors appearance-none shadow-sm">
                            <option>Semua Status</option>
                            <option>Selesai</option>
                            <option>Berjalan</option>
                            <option>Belum Mulai</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                {{-- Mitra MBKM --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5">Mitra MBKM</label>
                    <div class="relative">
                        <select class="block w-full pl-3 pr-10 py-2 border border-slate-200 rounded-lg leading-5 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors appearance-none shadow-sm">
                            <option>Semua Mitra</option>
                            <option>PT Telekomunikasi Indonesia</option>
                            <option>Bank Mandiri</option>
                            <option>Kementerian Pendidikan</option>
                            <option>Gojek Indonesia</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                {{-- Periode --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5">Periode (Mulai - Selesai)</label>
                    <div class="flex items-center gap-2">
                        <input type="text" value="01/01/2024" class="block w-full px-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-sm">
                        <span class="text-slate-400 font-bold">-</span>
                        <input type="text" value="06/30/2024" class="block w-full px-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-sm">
                    </div>
                </div>

                {{-- Status Penilaian --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5">Status Penilaian</label>
                    <div class="relative">
                        <select class="block w-full pl-3 pr-10 py-2 border border-slate-200 rounded-lg leading-5 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors appearance-none shadow-sm">
                            <option>Semua Penilaian</option>
                            <option>Lengkap</option>
                            <option>Sebagian</option>
                            <option>Belum Dinilai</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
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
                        <th scope="col" class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Status MBKM
                        </th>
                        <th scope="col" class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nilai Final
                        </th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                            SKS Konversi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    {{-- Row 1: Selesai --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">190203001</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight hover:text-blue-800 transition-colors cursor-pointer">Ahmad Fauzi</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-700">PT Telekomunikasi Indonesia</span>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-700 tracking-wide">
                                Selesai
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-bold text-slate-900">A (4.00)</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-sm font-bold text-slate-900">20</span>
                        </td>
                    </tr>

                    {{-- Row 2: Berjalan --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">190203015</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight hover:text-blue-800 transition-colors cursor-pointer">Budi Santoso</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-700">Bank Mandiri</span>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-600 tracking-wide">
                                Berjalan
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-bold text-slate-400">-</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-sm font-medium text-slate-400">Menunggu</span>
                        </td>
                    </tr>

                    {{-- Row 3: Selesai --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">190203042</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight hover:text-blue-800 transition-colors cursor-pointer">Citra Lestari</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-700">Kementerian Pendidikan</span>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-700 tracking-wide">
                                Selesai
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-bold text-slate-900">A- (3.75)</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-sm font-bold text-slate-900">20</span>
                        </td>
                    </tr>

                    {{-- Row 4: Belum Mulai --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">190203088</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight hover:text-blue-800 transition-colors cursor-pointer">Dewi Sartika</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-700">Gojek Indonesia</span>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 tracking-wide">
                                Belum Mulai
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-bold text-slate-400">-</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-sm font-medium text-slate-400">Menunggu</span>
                        </td>
                    </tr>

                    {{-- Row 5: Berjalan --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">190203102</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight hover:text-blue-800 transition-colors cursor-pointer">Eko Prasetyo</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-medium text-slate-700">PT Paragon Technology</span>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-600 tracking-wide">
                                Berjalan
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-sm font-bold text-slate-400">-</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-sm font-medium text-slate-400">Menunggu</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection
