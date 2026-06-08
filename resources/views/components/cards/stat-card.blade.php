{{-- resources/views/components/cards/stat-card.blade.php --}}
@props(['icon' => null, 'title', 'value', 'color' => 'blue'])

<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-slate-600 text-sm">{{ $title }}</p>
            <p class="text-2xl font-bold text-slate-900">{{ $value }}</p>
        </div>
        @if($icon)
        <div class="bg-{{ $color }}-100 p-3 rounded-lg">
            {!! $icon !!}
        </div>
        @endif
    </div>
</div>
