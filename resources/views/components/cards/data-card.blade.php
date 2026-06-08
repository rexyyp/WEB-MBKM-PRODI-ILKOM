{{-- resources/views/components/cards/data-card.blade.php --}}
@props(['title', 'subtitle' => null])

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="font-semibold text-slate-900 mb-4">{{ $title }}</h3>
    @if($subtitle)
    <p class="text-sm text-slate-600 mb-4">{{ $subtitle }}</p>
    @endif
    
    <div class="space-y-3">
        {{ $slot }}
    </div>
</div>
