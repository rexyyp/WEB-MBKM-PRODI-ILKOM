@extends('layouts.admin')

@section('title', 'Monitoring Kegiatan - Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Monitoring Kegiatan</h1>
        <p class="text-slate-600">Pantau progres semua mahasiswa dalam kegiatan MBKM</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-slate-600 text-sm">Kegiatan Aktif</p>
            <p class="text-2xl font-bold text-slate-900">198</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-slate-600 text-sm">Selesai</p>
            <p class="text-2xl font-bold text-slate-900">32</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-slate-600 text-sm">Tertunda</p>
            <p class="text-2xl font-bold text-slate-900">5</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-slate-600 text-sm">Ditolak</p>
            <p class="text-2xl font-bold text-slate-900">2</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Program</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Progress</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">Adi Permana</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Internship</td>
                    <td class="px-6 py-4">
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
