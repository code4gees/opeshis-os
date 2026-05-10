<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<?php $__env->startSection('title', 'Hospital Analytics - Opeshis OS'); ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">

 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">Analytics & Reports</h1>
 <p class="text-sm text-slate-400 mt-1">Institutional performance tracking, clinical outcomes, and resource management.</p>
 </div>
 <div class="mt-4 md:mt-0 flex gap-3">
 <button class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-bold rounded-lg transition-colors border border-slate-600">Export DHIS2 Data</button>
 <button class="px-4 py-2 bg-sage hover:bg-sage text-white text-xs font-bold rounded-lg /10 transition-colors">Download PDF Report</button>
 </div>
 </header>

 <!-- KPI Summary Row -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-xs font-bold text-slate-500 font-medium mb-4">Billing Efficiency</p>
 <div class="flex items-end gap-2">
 <h3 class="text-4xl font-bold text-white"><?php echo e(number_format($collectionEfficiency, 1)); ?>%</h3>
 <span class="text-xs font-bold text-emerald-500 mb-1">+2.1%</span>
 </div>
 <div class="w-full bg-card h-1.5 rounded-full mt-6 overflow-hidden">
 <div class="bg-emerald-500 h-full" style="width: <?php echo e($collectionEfficiency); ?>%"></div>
 </div>
 </div>

 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-xs font-bold text-slate-500 font-medium mb-4">Avg. Patient Wait (OPD)</p>
 <div class="flex items-end gap-2">
 <h3 class="text-4xl font-bold text-sage"><?php echo e($avgWaitTime); ?>m</h3>
 <span class="text-xs font-bold text-slate-600 mb-1">Target: 30m</span>
 </div>
 </div>

 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-xs font-bold text-slate-500 font-medium mb-4">Total Revenue (FCFA)</p>
 <h3 class="text-3xl font-bold text-white"><?php echo e(number_format($totalCollected, 0)); ?></h3>
 <p class="text-[12px] text-slate-600 mt-2 font-medium">Billed: <?php echo e(number_format($totalBilled, 0)); ?></p>
 </div>

 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle relative overflow-hidden">
 <p class="text-xs font-bold text-slate-500 font-medium mb-4">System Availability</p>
 <h3 class="text-4xl font-bold text-emerald-500 ">99.9%</h3>
 <div class="flex gap-1 mt-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i=0; $i<15; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?> <div class="w-2 h-3 bg-emerald-500/20 rounded-sm"></div> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 </div>
 </div>

 <!-- Charts Row -->
 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <!-- Patient Growth -->
 <div class="lg:col-span-2 bg-[#2a2e38] p-8 rounded-xl border border-subtle ">
 <h3 class="text-sm font-bold text-slate-200 font-medium mb-8">Patient Registration Trends</h3>
 <div class="h-80">
 <canvas id="growthChart"></canvas>
 </div>
 </div>

 <!-- Clinical Distribution -->
 <div class="lg:col-span-1 bg-[#2a2e38] p-8 rounded-xl border border-subtle flex flex-col">
 <h3 class="text-sm font-bold text-slate-200 font-medium mb-8 text-center">Top Clinical Diagnoses</h3>
 <div class="h-60 mb-8">
 <canvas id="morbidityChart"></canvas>
 </div>
 <div class="space-y-3">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $morbidityPulse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="flex justify-between items-center p-3 bg-card/40 rounded-lg border border-slate-700/40">
 <span class="text-xs font-semibold text-slate-400 truncate max-w-[140px]"><?php echo e($m->provisional_diagnosis); ?></span>
 <span class="text-xs font-bold text-sage"><?php echo e($m->count); ?> Cases</span>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 </div>
 </div>

 <!-- Inventory Alerts -->
 <div class="bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-6 border-b border-subtle bg-card/40 flex justify-between items-center">
 <h3 class="text-sm font-bold text-rose-400 font-medium">Critical Supply Depletion Warnings</h3>
 <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[12px] font-bold uppercase">Restock Required</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold">Item Name</th>
 <th class="px-6 py-5 font-semibold text-center">Current Stock</th>
 <th class="px-6 py-5 font-semibold text-center">Min. Level</th>
 <th class="px-6 py-5 font-semibold">Stock Status</th>
 <th class="px-8 py-5 text-right">Action</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $supplyRisk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-5">
 <div class="text-white font-bold uppercase text-xs"><?php echo e($item->item_name); ?></div>
 <div class="text-[12px] text-slate-500 font-medium mt-1 uppercase">Asset ID: <?php echo e($item->id); ?></div>
 </td>
 <td class="px-6 py-5 text-center">
 <span class="text-lg font-bold text-rose-500"><?php echo e($item->stock_level); ?></span>
 </td>
 <td class="px-6 py-5 text-center text-slate-500 font-bold"><?php echo e($item->reorder_level); ?></td>
 <td class="px-6 py-5">
 <div class="w-40 bg-card h-1.5 rounded-full overflow-hidden">
 <div class="bg-rose-500 h-full" style="width: <?php echo e(($item->stock_level / ($item->reorder_level ?: 1)) * 100); ?>%"></div>
 </div>
 </td>
 <td class="px-8 py-5 text-right">
 <button class="px-4 py-2 bg-slate-700 hover:bg-rose-600 text-slate-300 hover:text-white rounded-lg text-[12px] font-bold uppercase transition-all">Order Stock</button>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($supplyRisk->isEmpty()): ?>
 <tr>
 <td colspan="5" class="px-8 py-16 text-center text-slate-500 ">
 All medical supplies are currently at stable levels.
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
 // Growth Chart
 const growthCtx = document.getElementById('growthChart').getContext('2d');
 new Chart(growthCtx, {
 type: 'line',
 data: {
 labels: <?php echo json_encode($patientGrowth->pluck('month')); ?>,
 datasets: [{
 label: 'Patient Registrations',
 data: <?php echo json_encode($patientGrowth->pluck('count')); ?>,
 borderColor: '#3b82f6',
 backgroundColor: 'rgba(59, 130, 246, 0.05)',
 fill: true,
 tension: 0.4,
 borderWidth: 3,
 pointRadius: 4,
 pointBackgroundColor: '#3b82f6',
 }]
 },
 options: {
 responsive: true,
 maintainAspectRatio: false,
 plugins: { legend: { display: false } },
 scales: {
 y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#64748b', font: { size: 10, weight: 'bold' } } },
 x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 10, weight: 'bold' } } }
 }
 }
 });

 // Morbidity Chart
 const morbidityCtx = document.getElementById('morbidityChart').getContext('2d');
 new Chart(morbidityCtx, {
 type: 'doughnut',
 data: {
 labels: <?php echo json_encode($morbidityPulse->pluck('provisional_diagnosis')); ?>,
 datasets: [{
 data: <?php echo json_encode($morbidityPulse->pluck('count')); ?>,
 backgroundColor: ['#3b82f6', '#f43f5e', '#fbbf24', '#10b981', '#8b5cf6'],
 borderWidth: 0,
 cutout: '80%',
 }]
 },
 options: {
 responsive: true,
 maintainAspectRatio: false,
 plugins: { legend: { display: false } }
 }
 });
});
</script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f9e428c85f73cee41ce4c693f314c57)): ?>
<?php $attributes = $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57; ?>
<?php unset($__attributesOriginal5f9e428c85f73cee41ce4c693f314c57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f9e428c85f73cee41ce4c693f314c57)): ?>
<?php $component = $__componentOriginal5f9e428c85f73cee41ce4c693f314c57; ?>
<?php unset($__componentOriginal5f9e428c85f73cee41ce4c693f314c57); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\opeshis\resources\views\analytics.blade.php ENDPATH**/ ?>