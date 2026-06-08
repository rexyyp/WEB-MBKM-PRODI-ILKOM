@extends('layouts.admin')

@section('title', 'Detail Mahasiswa - Admin')

@section('content')
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.mahasiswa.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali</a>
        <h1 class="text-3xl font-bold text-slate-900">Detail Mahasiswa</h1>
    </div>

    <div class="grid grid-cols-3 gap-6">
        {{-- Main Info --}}
        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Informasi Personal</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-slate-600">NIM</label>
                            <p class="text-slate-900">2301001</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-600">Nama</label>
                            <p class="text-slate-900">Adi Permana</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-slate-600">Program</label>
                            <p class="text-slate-900">Internship</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-600">Mitra</label>
                            <p class="text-slate-900">PT Maju Jaya</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Timeline Kegiatan</h2>
                <div class="space-y-3">
                    <div class="flex gap-4">
                        <div class="w-2 h-12 bg-green-500 rounded"></div>
                        <div>
                            <p class="font-medium text-slate-900">Pendaftaran Diterima</p>
                            <p class="text-sm text-slate-500">1 Januari 2024</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-2 h-12 bg-green-500 rounded"></div>
                        <div>
                            <p class="font-medium text-slate-900">Penempatan Dikonfirmasi</p>
                            <p class="text-sm text-slate-500">5 Januari 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-slate-900 mb-3">Status</h3>
                <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-2 rounded-full">Aktif</span>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-slate-900 mb-3">Aksi</h3>
                <div class="space-y-2">
                    <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Edit</button>
                    <button class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection
