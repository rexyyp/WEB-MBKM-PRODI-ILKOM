@extends('layouts.admin')

@section('title', 'Penugasan Pembimbing - Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Penugasan Pembimbing</h1>
        <p class="text-slate-600">Kelola penugasan dosen pembimbing untuk mahasiswa</p>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex gap-4">
            <input type="text" placeholder="Cari mahasiswa..." class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Cari</button>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Program</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Dosen Pembimbing</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">Adi Permana</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Internship</td>
                    <td class="px-6 py-4 text-sm text-slate-600">Dr. Budi Santoso</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Ditugaskan</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-800">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
