@props(['label' => null, 'name' => null, 'type' => 'text', 'placeholder' => '', 'value' => '', 'icon' => null, 'compact' => false])

<div class="{{ $compact ? 'space-y-1' : 'space-y-2' }}">
    @if($label)
    <label for="{{ $name }}" class="block text-[10px] font-bold uppercase tracking-[0.15em] text-slate-500 ml-1">
        {{ $label }}
    </label>
    @endif
    
    <div class="relative group">
        @if($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cobalt transition-colors">
            <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
        </div>
        @endif
        
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            placeholder="{{ $placeholder }}" 
            value="{{ $value }}"
            {{ $attributes->merge(['class' => ($icon ? 'pl-11' : 'px-4') . ' w-full bg-surface-base border border-white/5 rounded-xl ' . ($compact ? 'py-2' : 'py-3') . ' text-xs font-medium text-slate-100 placeholder-slate-600 outline-none focus:border-cobalt/50 focus:ring-4 focus:ring-cobalt/10 transition-all']) }}
        >
    </div>
</div>
