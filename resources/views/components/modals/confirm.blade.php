{{-- resources/views/components/modals/confirm.blade.php --}}
@props(['id', 'title', 'message', 'confirmText' => 'Konfirmasi', 'cancelText' => 'Batal'])

<div id="{{ $id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm">
        <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $title }}</h3>
        <p class="text-slate-600 mb-6">{{ $message }}</p>
        
        <div class="flex gap-3">
            <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="flex-1 bg-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-400">
                {{ $cancelText }}
            </button>
            <button class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>
