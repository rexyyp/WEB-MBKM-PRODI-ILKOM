@php
    $steps = [
        1 => 'Persiapan (Proposal)',
        2 => 'Pendaftaran',
        3 => 'Pelaksanaan (Logbook)',
        4 => 'Evaluasi (Laporan & Nilai)'
    ];
@endphp

<div class="w-full overflow-x-auto py-4">
    <div class="flex items-start min-w-[600px] w-full px-2">
        @foreach($steps as $step => $label)
            <div class="flex flex-col items-center flex-1 relative">
                <div class="w-full flex items-center justify-center relative">
                    {{-- Connector Left --}}
                    @if($step > 1)
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-[calc(50%-1.25rem)] h-[2px] bg-blue-600"></div>
                    @endif
                    
                    {{-- Connector Right --}}
                    @if($step < count($steps))
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[calc(50%-1.25rem)] h-[2px] bg-blue-600"></div>
                    @endif

                    {{-- Circle --}}
                    <div class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full border-2 border-blue-600 bg-white text-blue-600 transition-all duration-300">
                        <span class="font-bold text-sm">{{ $step }}</span>
                    </div>
                </div>

                {{-- Label --}}
                <div class="mt-3 text-center px-2">
                    <p class="text-xs md:text-sm leading-tight text-blue-600 font-medium">
                        {{ $label }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
