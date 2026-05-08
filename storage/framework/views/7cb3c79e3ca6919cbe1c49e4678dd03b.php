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


<?php $__env->startSection('title', 'Chronic Care (NCD) - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-800 border border-slate-700/60 rounded-xl p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-slate-100 tracking-tight">Chronic Care (NCD)</h1>
            <p class="text-sm text-slate-400 mt-1">Management of Non-Communicable Diseases and longitudinal patient tracking.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="document.getElementById('enrollModal').classList.remove('hidden')" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-lg transition-all shadow-lg shadow-blue-500/20">
                Register Chronic Case
            </button>
        </div>
    </header>

    <!-- NCD Registry KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm relative overflow-hidden">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Registry Census</p>
            <h3 class="text-3xl font-bold text-slate-100 tracking-tight"><?php echo e($registry->count()); ?> <span class="text-xs font-medium text-slate-500 ml-1 uppercase">Patients</span></h3>
            <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-blue-500/5 rounded-full blur-xl"></div>
        </div>
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm">
            <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-wider mb-2">Therapeutic Stability</p>
            <h3 class="text-3xl font-bold text-emerald-500 tracking-tight">88.4%</h3>
        </div>
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm">
            <p class="text-[10px] font-bold text-rose-500 uppercase tracking-wider mb-2">Late Follow-ups</p>
            <h3 class="text-3xl font-bold text-rose-500 tracking-tight">12</h3>
        </div>
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Institutional Status</p>
            <h3 class="text-lg font-bold text-slate-100 uppercase tracking-tight">Operational</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
        <!-- Registry Table -->
        <div class="xl:col-span-8 bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-700/60 bg-slate-900/40 flex justify-between items-center">
                <h3 class="text-sm font-bold text-slate-200">Chronic Disease Registry</h3>
                <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded text-[9px] font-bold uppercase tracking-wider">Active Sync</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-8 py-5 font-semibold uppercase text-[11px] tracking-wider">Patient Details</th>
                            <th class="px-6 py-5 font-semibold uppercase text-[11px] tracking-wider">Condition</th>
                            <th class="px-6 py-5 font-semibold uppercase text-[11px] tracking-wider">Last Encounter</th>
                            <th class="px-6 py-5 text-center font-semibold uppercase text-[11px] tracking-wider">Stability</th>
                            <th class="px-8 py-5 text-right uppercase text-[11px] tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $registry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-slate-100 uppercase text-xs"><?php echo e($r->full_name); ?></div>
                                    <div class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5"><?php echo e($r->medical_id); ?></div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded text-[9px] font-bold uppercase tracking-wider"><?php echo e($r->condition_type); ?></span>
                                </td>
                                <td class="px-6 py-6 text-[11px] font-bold text-slate-400 uppercase">
                                    <?php echo e($r->last_seen ? \Carbon\Carbon::parse($r->last_seen)->format('d M, Y') : 'Pending Intake'); ?>

                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                        <span class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest">Stable</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button onclick="viewTrends('<?php echo e($r->patient_id); ?>', '<?php echo e(addslashes($r->full_name)); ?>')" class="inline-flex items-center gap-2 text-[10px] font-bold text-blue-500 uppercase hover:text-blue-400 transition-colors">
                                        View Trends
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-slate-500 italic text-sm">No chronic care patients found in the registry.</td>
                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Trend Sidebar -->
        <div id="trendView" class="xl:col-span-4 bg-slate-800 rounded-xl p-8 border border-slate-700/60 shadow-sm hidden relative overflow-hidden">
            <h4 id="trendTitle" class="text-xs font-bold text-slate-100 uppercase tracking-wider mb-8 border-b border-slate-700/60 pb-4">Patient Health Trends</h4>
            <div class="h-[200px] mb-8"><canvas id="trendChart"></canvas></div>
            <div class="space-y-6">
                <div class="p-5 bg-blue-500/5 rounded-lg border border-blue-500/10">
                    <p class="text-[9px] font-bold text-blue-400 uppercase tracking-wider mb-2">Clinical Assessment</p>
                    <p class="text-[11px] text-slate-400 leading-relaxed italic">Patient shows steady therapeutic adherence. Recommended to continue current management plan.</p>
                </div>
                <button class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-xs font-bold uppercase transition-all shadow-lg shadow-blue-600/20">Log Health Metric</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: New Enrollment -->
<div id="enrollModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
    <div class="bg-slate-800 w-full max-w-xl rounded-xl p-8 shadow-2xl border border-slate-700/60">
        <h3 class="text-xl font-bold text-slate-100 mb-8 uppercase flex items-center gap-3">
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
            Chronic Care Registry Enrollment
        </h3>
        <form method="POST" action="<?php echo e(route('ncd.enroll')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Patient Medical ID</label>
                <input type="text" name="patient_id" required placeholder="Enter Patient ID..." class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Primary Chronic Condition</label>
                <select name="condition" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Hypertension (HTN)</option>
                    <option>Diabetes Mellitus (T2DM)</option>
                    <option>Asthma / COPD</option>
                    <option>Sickle Cell Disease (SCD)</option>
                    <option>HIV / ART Monitoring</option>
                    <option>Chronic Kidney Disease (CKD)</option>
                </select>
            </div>
            <div class="flex gap-4 mt-8 pt-6 border-t border-slate-700/60">
                <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-sm font-bold transition-all shadow-lg shadow-blue-600/20">Enroll Patient</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chart = null;

    function viewTrends(patientId, name) {
        document.getElementById('trendView').classList.remove('hidden');
        document.getElementById('trendTitle').textContent = `Trends: ${name.toUpperCase()}`;

        fetch(`/ncd/trends/${patientId}`)
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    renderChart(data.data);
                }
            });
    }

    function renderChart(data) {
        const ctx = document.getElementById('trendChart').getContext('2d');
        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(d => new Date(d.measured_at).toLocaleDateString()),
                datasets: [{
                    label: 'Clinical Metric',
                    data: data.map(d => d.metric_value),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#64748b', font: { size: 9, weight: 'bold' } } },
                    x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 9, weight: 'bold' } } }
                }
            }
        });
    }
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\ncd\index.blade.php ENDPATH**/ ?>