{{-- resources/views/components/forms/input.blade.php --}}
@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'required' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-900 mb-2">
        {{ $label }}
        @if($required)
        <span class="text-red-600">*</span>
        @endif
    </label>
    <input 
        type="{{ $type }}" 
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
</div>
