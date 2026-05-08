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


<?php $__env->startSection('title', 'Inventory & Supply Chain - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-800 border border-slate-700/60 rounded-xl p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-slate-100 tracking-tight">Inventory Management</h1>
            <p class="text-sm text-slate-400 mt-1">Manage hospital stock, medical supplies, and vendor relations.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="document.getElementById('addStockModal').classList.remove('hidden')" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-lg shadow-sm shadow-blue-500/10 transition-colors">
                Receive New Stock
            </button>
        </div>
    </header>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-sm font-medium">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Secondary Navigation -->
    <div class="flex flex-wrap border-b border-slate-700/60 gap-8 px-2">
        <?php
            $subnav = function($sub, $label) use ($tab) {
                $active = $tab === $sub;
                $cls = $active ? 'text-blue-500 border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300';
                return "<a href=\"".route('warehouse', ['subtab' => $sub])."\" class=\"pb-4 text-sm font-bold border-b-2 transition-all {$cls}\">{$label}</a>";
            };
        ?>
        <?php echo $subnav('dashboard', 'Overview'); ?>

        <?php echo $subnav('stock', 'Inventory List'); ?>

        <?php echo $subnav('requisitions', 'Stock Requests'); ?>

        <?php echo $subnav('vendors', 'Suppliers'); ?>

    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'dashboard'): ?>
        <!-- Inventory KPIs -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Total SKUs</p>
                <h3 class="text-3xl font-bold text-slate-100"><?php echo e(number_format($stats['total_items'])); ?></h3>
            </div>
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Inventory Value</p>
                <h3 class="text-3xl font-bold text-emerald-500">XAF <?php echo e(number_format($stats['total_value'])); ?></h3>
            </div>
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pending Requests</p>
                <h3 class="text-3xl font-bold text-blue-500"><?php echo e($stats['pending_reqs']); ?></h3>
            </div>
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-rose-500 uppercase tracking-wider mb-2">Low Stock Alerts</p>
                <h3 class="text-3xl font-bold text-rose-500"><?php echo e($stats['expiring_soon']); ?></h3>
            </div>
        </div>

        <!-- Blood Bank Snapshot -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider px-2">Blood Bank Reserves</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($bloodBank)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bloodBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="bg-slate-800 p-4 rounded-xl border border-slate-700/60 text-center">
                            <span class="text-xs font-bold text-slate-500 block mb-1"><?php echo e($b->blood_group); ?></span>
                            <div class="text-xl font-bold <?php echo e($b->units_available < 10 ? 'text-rose-500' : 'text-slate-100'); ?>"><?php echo e($b->units_available); ?></div>
                            <span class="text-[10px] text-slate-600 font-medium uppercase">Units</span>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                <h3 class="text-sm font-bold text-slate-200">Recent Movements</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-6 py-4 font-semibold">Type</th>
                            <th class="px-6 py-4 font-semibold">Item</th>
                            <th class="px-6 py-4 font-semibold">User</th>
                            <th class="px-6 py-4 font-semibold">Date</th>
                            <th class="px-6 py-4 font-semibold text-right">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recent_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold <?php echo e($a->movement_type === 'IN' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500'); ?>">
                                        <?php echo e($a->movement_type); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-200 font-medium"><?php echo e($a->item_name); ?></td>
                                <td class="px-6 py-4 text-slate-400"><?php echo e($a->user_name ?? 'System'); ?></td>
                                <td class="px-6 py-4 text-slate-400"><?php echo e(\Carbon\Carbon::parse($a->created_at)->format('d M, H:i')); ?></td>
                                <td class="px-6 py-4 text-right font-bold <?php echo e($a->movement_type === 'IN' ? 'text-emerald-500' : 'text-rose-500'); ?>">
                                    <?php echo e($a->movement_type === 'IN' ? '+' : '-'); ?><?php echo e($a->quantity); ?>

                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif($tab === 'stock'): ?>
        <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                <h3 class="text-sm font-bold text-slate-200">Current Stock Registry</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-6 py-4 font-semibold">Item Name</th>
                            <th class="px-6 py-4 font-semibold">Category</th>
                            <th class="px-6 py-4 font-semibold">Supplier</th>
                            <th class="px-6 py-4 font-semibold text-center">Available</th>
                            <th class="px-6 py-4 font-semibold text-right">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-slate-100 font-bold"><?php echo e($s->item_name); ?></div>
                                    <div class="text-[10px] text-slate-500 font-medium mt-0.5 uppercase">Batch: <?php echo e($s->batch_number ?: 'N/A'); ?></div>
                                </td>
                                <td class="px-6 py-4 text-slate-400"><?php echo e($s->category); ?></td>
                                <td class="px-6 py-4 text-slate-400"><?php echo e($s->vendor_name ?? 'Direct Purchase'); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-base font-bold <?php echo e($s->bulk_quantity <= $s->min_quantity ? 'text-rose-500' : 'text-slate-200'); ?>">
                                        <?php echo e(number_format($s->bulk_quantity)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-emerald-500 font-bold"><?php echo e(number_format($s->unit_cost)); ?> XAF</td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif($tab === 'requisitions'): ?>
        <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                <h3 class="text-sm font-bold text-slate-200">Departmental Requests</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-6 py-4 font-semibold">Requested Item</th>
                            <th class="px-6 py-4 font-semibold">Requester</th>
                            <th class="px-6 py-4 font-semibold text-center">Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $requisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-slate-100 font-bold uppercase text-xs"><?php echo e($r->pharmacy_item_name); ?></div>
                                    <div class="text-[10px] text-slate-500 font-medium mt-0.5">QTY: <?php echo e($r->requested_qty); ?></div>
                                </td>
                                <td class="px-6 py-4 text-slate-400"><?php echo e($r->requester_name); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                        <?php if($r->status === 'completed'): ?> bg-emerald-500/10 text-emerald-500
                                        <?php elseif($r->status === 'dispatched'): ?> bg-blue-500/10 text-blue-500
                                        <?php else: ?> bg-slate-700 text-slate-400 <?php endif; ?>">
                                        <?php echo e($r->status); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r->status === 'pending'): ?>
                                        <button onclick="openDispatchModal('<?php echo e($r->id); ?>', '<?php echo e($r->pharmacy_item_name); ?>', <?php echo e($r->requested_qty); ?>)" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-bold rounded-lg transition-all">Approve Dispatch</button>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-500 italic">Fulfilled</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif($tab === 'vendors'): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                    <h3 class="text-sm font-bold text-slate-200">Supplier List</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-slate-500 border-b border-slate-700/60">
                                <th class="px-6 py-4 font-semibold">Supplier Name</th>
                                <th class="px-6 py-4 font-semibold text-center">Items Provided</th>
                                <th class="px-6 py-4 font-semibold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/40">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vendors ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-200 uppercase text-xs"><?php echo e($v->name); ?></div>
                                        <div class="text-[10px] text-slate-500 font-medium mt-0.5">Contact: <?php echo e($v->contact_person ?? 'N/A'); ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-300 font-bold"><?php echo e($v->item_count ?? 0); ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase <?php echo e(($v->status ?? 'active') === 'active' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500'); ?>">
                                            <?php echo e($v->status ?? 'active'); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Vendor -->
            <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm p-6 h-fit">
                <h3 class="text-sm font-bold text-slate-200 mb-6">Register New Supplier</h3>
                <form method="POST" action="<?php echo e(route('warehouse.action')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="register_vendor">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Company Name</label>
                        <input type="text" name="name" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600" placeholder="e.g. PharmaCorp Ltd">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Contact Person</label>
                        <input type="text" name="contact_person" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email / Phone</label>
                        <input type="text" name="email" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-bold transition-all">Register Supplier</button>
                </form>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<!-- Modal: Add Stock -->
<div id="addStockModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
    <div class="bg-slate-800 w-full max-w-lg rounded-xl p-8 shadow-2xl border border-slate-700/60">
        <h3 class="text-xl font-bold text-slate-100 mb-6">Stock Intake Entry</h3>
        <form method="POST" action="<?php echo e(route('warehouse.action')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="add_stock">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Item Name</label>
                <input type="text" name="item_name" required placeholder="e.g. Paracetamol 500mg" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Category</label>
                    <input type="text" name="category" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Quantity</label>
                    <input type="number" name="bulk_quantity" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>
            <div class="flex gap-3 mt-8">
                <button type="button" onclick="document.getElementById('addStockModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-sm font-bold transition-all shadow-lg shadow-blue-600/20">Save Stock Entry</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDispatchModal(id, name, qty) {
        // Simple logic for demonstration - can be expanded to a real dispatch modal
        if(confirm("Confirm dispatch of " + qty + " units of " + name + "?")) {
            // Submit form logic here
        }
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\warehouse.blade.php ENDPATH**/ ?>