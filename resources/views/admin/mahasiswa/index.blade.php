@extends('layouts.admin')

@section('title', 'Data Mahasiswa - Admin')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Data Mahasiswa</h1>
            <p class="text-slate-600">Kelola data mahasiswa MBKM</p>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Tambah Mahasiswa</button>
    </div>

    {{-- Filter and Search --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex gap-4">
            <input type="text" placeholder="Cari mahasiswa..." class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Selesai</option>
                <option>Ditolak</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">NIM</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Program</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Mitra</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-slate-600">2301001</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">Adi Permana</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Internship</td>
                    <td class="px-6 py-4 text-sm text-slate-600">PT Maju Jaya</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.mahasiswa.detail', 1) }}" class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-slate-600">2301002</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">Bela Sari</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Magang</td>
                    <td class="px-6 py-4 text-sm text-slate-600">CV Indonesia Digital</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.mahasiswa.detail', 2) }}" class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
