@extends('layouts.admin')

@section('title', 'Data Mitra - Admin')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Data Mitra</h1>
            <p class="text-slate-600">Kelola data mitra industri</p>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Tambah Mitra</button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Nama Mitra</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Industri</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Lokasi</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Kontak</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">PT Maju Jaya</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Teknologi</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Jakarta</td>
                    <td class="px-6 py-4 text-sm text-slate-600">021-xxxx-xxxx</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-800">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
