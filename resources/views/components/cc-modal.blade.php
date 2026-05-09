@props(['id', 'title', 'icon' => null])

<div id="{{ $id }}" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-[#1a1d24]/80  transition-opacity"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-[#2a2e38] border border-slate-700/60 text-left  transition-all sm:my-8 sm:w-full sm:max-w-xl">
            <!-- Header -->
            <div class="bg-card/50 px-6 py-4 border-b border-slate-700/60 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if($icon)
                        <div class="w-8 h-8 rounded-lg bg-sage/10 flex items-center justify-center border border-blue-500/20 text-sage">
                            <i class="fas {{ $icon }} text-xs"></i>
                        </div>
                    @endif
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-100" id="modal-title">{{ $title }}</h3>
                </div>
                <button type="button" onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="text-slate-500 hover:text-slate-300 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="px-6 py-6">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <!-- Footer -->
                <div class="bg-card/50 px-6 py-4 border-t border-slate-700/60 flex flex-row-reverse gap-3">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
