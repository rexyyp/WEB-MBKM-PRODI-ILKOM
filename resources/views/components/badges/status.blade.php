{{-- resources/views/components/badges/status.blade.php --}}
@props(['status'])

@php
$colors = [
    'active' => 'bg-green-100 text-green-800',
    'inactive' => 'bg-red-100 text-red-800',
    'pending' => 'bg-yellow-100 text-yellow-800',
    'approved' => 'bg-blue-100 text-blue-800',
    'rejected' => 'bg-red-100 text-red-800',
];

$statusLabels = [
    'active' => 'Aktif',
    'inactive' => 'Tidak Aktif',
    'pending' => 'Menunggu',
    'approved' => 'Disetujui',
    'rejected' => 'Ditolak',
];

$color = $colors[$status] ?? 'bg-slate-100 text-slate-800';
$label = $statusLabels[$status] ?? ucfirst($status);
@endphp

<span class="inline-block {{ $color }} text-xs font-semibold px-3 py-1 rounded-full">
    {{ $label }}
</span>
