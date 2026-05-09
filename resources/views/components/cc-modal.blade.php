@props(['id', 'title', 'icon' => null, 'maxWidth' => 'xl'])

<div id="{{ $id }}" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-md transition-opacity"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden cc-card shadow-2xl text-left transition-all sm:my-8 sm:w-full 
            {{ $maxWidth === 'sm' ? 'sm:max-w-sm' : ($maxWidth === 'md' ? 'sm:max-w-md' : ($maxWidth === 'lg' ? 'sm:max-w-lg' : 'sm:max-w-xl')) }}">
            
            <!-- Header -->
            <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                <div class="flex items-center gap-4">
                    @if($icon)
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center text-sage">
                            <i class="fas {{ $icon }} text-[14px]"></i>
                        </div>
                    @endif
                    <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]" id="modal-title">{{ $title }}</h3>
                </div>
                <button type="button" onclick="document.getElementById('{{ $id }}').classList.add('hidden')" 
                    class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                    <i class="fas fa-times text-[10px]"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-8">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <!-- Footer -->
                <div class="px-8 py-6 border-t border-white/[0.04] flex flex-row-reverse gap-4 bg-white/[0.01]">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
