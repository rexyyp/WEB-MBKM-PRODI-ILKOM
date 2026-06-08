@extends('layouts.admin')

@section('title', 'Penilaian - Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Penilaian Kegiatan MBKM</h1>
        <p class="text-slate-600">Lihat dan kelola penilaian dari dosen pembimbing</p>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex gap-4">
            <input type="text" placeholder="Cari mahasiswa..." class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Semua Status</option>
                <option>Dinilai</option>
                <option>Menunggu</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Dosen Pembimbing</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Nilai</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Grade</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">Adi Permana</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Dr. Budi Santoso</td>
                    <td class="px-6 py-4 text-sm text-slate-900 font-medium">85</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">A</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Dinilai</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-800">Lihat</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
