<div wire:poll.5s="refreshVitals" class="space-y-4">
 <div class="flex items-center justify-between mb-4">
 <h3 class="text-[12px] font-semibold text-slate-500 font-medium ">Institutional Telemetry Stream</h3>
 <div class="flex items-center gap-2 px-2 py-1 bg-rose-500/10 border border-rose-500/20 rounded-full">
 <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
 <span class="text-[8px] font-semibold text-rose-500 font-medium leading-none">Live Signal</span>
 </div>
 </div>

 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
 <?php $latest = $vitals->first(); ?>

 <div class="p-5 bg-card/40 border border-subtle rounded-2xl hover:border-indigo-500/30 transition-all group">
 <div class="flex items-center gap-3 mb-3">
 <i class="fas fa-heart-pulse text-rose-500 text-xs"></i>
 <span class="text-[8px] font-semibold text-slate-500 font-medium">Pulse Rate</span>
 </div>
 <div class="flex items-baseline gap-2">
 <span class="text-2xl font-semibold text-white tracking-tighter"><?php echo e($latest->heart_rate ?? '--'); ?></span>
 <span class="text-[8px] font-semibold text-slate-600 uppercase">BPM</span>
 </div>
 </div>

 <div class="p-5 bg-card/40 border border-subtle rounded-2xl hover:border-indigo-500/30 transition-all group">
 <div class="flex items-center gap-3 mb-3">
 <i class="fas fa-droplet text-sage text-xs"></i>
 <span class="text-[8px] font-semibold text-slate-500 font-medium">SpO2 Level</span>
 </div>
 <div class="flex items-baseline gap-2">
 <span class="text-2xl font-semibold text-white tracking-tighter"><?php echo e($latest->spo2 ?? '--'); ?></span>
 <span class="text-[8px] font-semibold text-slate-600 uppercase">%</span>
 </div>
 </div>

 <div class="p-5 bg-card/40 border border-subtle rounded-2xl hover:border-indigo-500/30 transition-all group">
 <div class="flex items-center gap-3 mb-3">
 <i class="fas fa-temperature-high text-amber-500 text-xs"></i>
 <span class="text-[8px] font-semibold text-slate-500 font-medium">Core Temp</span>
 </div>
 <div class="flex items-baseline gap-2">
 <span class="text-2xl font-semibold text-white tracking-tighter"><?php echo e($latest->temperature ?? '--'); ?></span>
 <span class="text-[8px] font-semibold text-slate-600 uppercase">°C</span>
 </div>
 </div>

 <div class="p-5 bg-card/40 border border-subtle rounded-2xl hover:border-indigo-500/30 transition-all group">
 <div class="flex items-center gap-3 mb-3">
 <i class="fas fa-lungs text-emerald-500 text-xs"></i>
 <span class="text-[8px] font-semibold text-slate-500 font-medium">Resp Rate</span>
 </div>
 <div class="flex items-baseline gap-2">
 <span class="text-2xl font-semibold text-white tracking-tighter"><?php echo e($latest->respiratory_rate ?? '--'); ?></span>
 <span class="text-[8px] font-semibold text-slate-600 uppercase">BPM</span>
 </div>
 </div>
 </div>
</div>
<?php /**PATH C:\laragon\www\opeshis\resources\views\livewire\vitals-monitor.blade.php ENDPATH**/ ?>