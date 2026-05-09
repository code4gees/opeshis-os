@props(['label' => null, 'name' => null, 'type' => 'text', 'placeholder' => '', 'value' => '', 'icon' => null])

<div class="space-y-2">
    @if($label)
    <label for="{{ $name }}" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">
        {{ $label }}
    </label>
    @endif
    
    <div class="relative group">
        @if($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-sage transition-colors">
            <i class="fas {{ $icon }} text-xs"></i>
        </div>
        @endif
        
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            placeholder="{{ $placeholder }}" 
            value="{{ $value }}"
            {{ $attributes->merge(['class' => ($icon ? 'pl-11' : 'px-4') . ' w-full bg-card/50 border border-subtle rounded-xl py-3 text-xs font-bold text-white placeholder-slate-600 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all ']) }}
        >
    </div>
</div>
