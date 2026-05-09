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


<?php $__env->startSection('title', 'Appointments Hub - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
 
 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">Appointments Hub</h1>
 <p class="text-sm text-slate-400 mt-1">Manage institutional appointment schedules and patient queues.</p>
 </div>
 <div class="mt-4 md:mt-0">
 <button onclick="document.getElementById('bookModal').classList.remove('hidden')" class="px-5 py-2.5 bg-sage hover:bg-sage text-white text-sm font-bold rounded-lg transition-all /20">
 New Appointment
 </button>
 </div>
 </header>

 <!-- Date Picker & Controls -->
 <div class="flex flex-col md:flex-row items-center gap-6">
 <div class="flex bg-[#2a2e38] rounded-lg border border-subtle p-1 ">
 <a href="<?php echo e(route('appointments.index', ['date' => \Carbon\Carbon::parse($date)->subDay()->toDateString()])); ?>" class="p-3 text-slate-400 hover:text-sage transition-colors">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
 </a>
 <div class="px-6 py-2 text-xs font-bold text-slate-200 font-medium flex items-center border-x border-subtle">
 <?php echo e(\Carbon\Carbon::parse($date)->format('D, M d, Y')); ?>

 </div>
 <a href="<?php echo e(route('appointments.index', ['date' => \Carbon\Carbon::parse($date)->addDay()->toDateString()])); ?>" class="p-3 text-slate-400 hover:text-sage transition-colors">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
 </a>
 </div>
 <div class="relative">
 <input type="date" value="<?php echo e($date); ?>" onchange="location.href='?date='+this.value" class="bg-card border border-subtle rounded-lg px-6 py-2.5 text-xs font-bold font-medium text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all cursor-pointer">
 </div>
 </div>

 <!-- Pending Digital Requests -->
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($requests->isNotEmpty()): ?>
 <div class="bg-[#2a2e38] rounded-xl p-8 border border-subtle bg-card relative overflow-hidden">
 <h3 class="text-[12px] font-bold text-amber-500 font-medium mb-8">Pending Portal Requests (<?php echo e($requests->count()); ?>)</h3>
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-card/40 p-6 rounded-lg border border-subtle hover:border-amber-500/30 transition-all group">
 <div class="flex justify-between items-start mb-4">
 <div>
 <h4 class="text-xs font-bold text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors"><?php echo e($req->full_name); ?></h4>
 <p class="text-[12px] text-slate-500 font-bold uppercase mt-1"><?php echo e($req->medical_id); ?></p>
 </div>
 <span class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[12px] font-bold uppercase"><?php echo e($req->urgency); ?></span>
 </div>
 <p class="text-[12px] text-slate-400 mb-6 border-l-2 border-amber-500/20 pl-4">"<?php echo e($req->reason); ?>"</p>
 <div class="flex gap-2">
 <button class="flex-1 py-2 bg-sage text-white rounded text-[12px] font-bold uppercase hover:bg-sage transition-all">Approve</button>
 <button class="flex-1 py-2 bg-slate-700 text-slate-400 rounded text-[12px] font-bold uppercase hover:bg-slate-600 transition-all">Decline</button>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <!-- Main Schedule Ledger -->
 <div class="bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40 flex justify-between items-center">
 <h3 class="text-sm font-bold text-slate-200">Daily Appointment Ledger</h3>
 <span class="text-[12px] font-bold text-sage font-medium">Confirmed Today: <?php echo e($appointments->where('status', 'confirmed')->count()); ?></span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold uppercase text-[12px] tracking-wider">Schedule Time</th>
 <th class="px-8 py-5 font-semibold uppercase text-[12px] tracking-wider">Patient Details</th>
 <th class="px-8 py-5 font-semibold uppercase text-[12px] tracking-wider">Clinical Provider</th>
 <th class="px-8 py-5 text-center font-semibold uppercase text-[12px] tracking-wider">Status</th>
 <th class="px-8 py-5 text-right uppercase text-[12px] tracking-wider">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-6">
 <div class="text-lg font-bold text-sage tracking-tight">
 <?php echo e(\Carbon\Carbon::parse($a->appointment_time)->format('H:i')); ?>

 </div>
 </td>
 <td class="px-8 py-6">
 <div class="font-bold text-white uppercase text-xs"><?php echo e($a->full_name); ?></div>
 <div class="text-[12px] text-slate-500 font-bold font-medium mt-0.5"><?php echo e($a->appointment_number); ?></div>
 </td>
 <td class="px-8 py-6">
 <div class="text-xs font-bold text-slate-300 uppercase tracking-tight"><?php echo e($a->doctor_name ?? 'Not Assigned'); ?></div>
 <div class="text-[12px] text-slate-500 font-bold font-medium mt-1"><?php echo e($a->dept_name ?? 'General Unit'); ?></div>
 </td>
 <td class="px-8 py-6 text-center">
 <?php
 $statusCls = [
 'completed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
 'scheduled' => 'bg-sage/10 text-sage border-blue-500/20',
 'confirmed' => 'bg-sky-500/10 text-sky-500 border-sky-500/20',
 'cancelled' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
 ];
 $cls = $statusCls[$a->status] ?? 'bg-card text-slate-500 border-slate-700';
 ?>
 <span class="px-2 py-0.5 rounded text-[12px] font-bold uppercase border <?php echo e($cls); ?>">
 <?php echo e($a->status); ?>

 </span>
 </td>
 <td class="px-8 py-6 text-right">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($a->status === 'scheduled' || $a->status === 'confirmed'): ?>
 <form method="POST" action="<?php echo e(route('appointments.checkin', $a->id)); ?>">
 <?php echo csrf_field(); ?>
 <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-[12px] font-bold uppercase transition-all /10">Patient Check-In</button>
 </form>
 <?php else: ?>
 <span class="text-[12px] font-bold text-slate-600 uppercase ">Archived</span>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="5" class="px-8 py-20 text-center">
 <svg class="mx-auto h-12 w-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
 <p class="mt-4 text-sm text-slate-500">No appointments scheduled for this date.</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Modal: New Appointment -->
<div id="bookModal" class="fixed inset-0 bg-card/80 z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-[#2a2e38] w-full max-w-2xl rounded-xl p-8 border border-subtle">
 <h3 class="text-xl font-bold text-white mb-8 uppercase flex items-center gap-3">
 <div class="w-2 h-2 bg-sage rounded-full animate-pulse"></div>
 New Appointment Booking
 </h3>
 <form method="POST" action="<?php echo e(route('appointments.store')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Patient Medical ID</label>
 <input type="text" name="patient_id" required placeholder="Enter Patient ID..." class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-6">
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Appointment Date</label>
 <input type="date" name="date" required value="<?php echo e($date); ?>" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Schedule Time</label>
 <input type="time" name="time" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-6">
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Assign Provider</label>
 <select name="doctor_id" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = DB::table('users')->whereIn('role', ['Doctor', 'Nurse'])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?> (<?php echo e($u->role); ?>)</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </select>
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Department</label>
 <select name="department_id" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?></option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </select>
 </div>
 </div>
 <div class="flex gap-4 mt-8 pt-6 border-t border-subtle">
 <button type="button" onclick="document.getElementById('bookModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-3 bg-sage hover:bg-sage text-white rounded-lg text-sm font-bold transition-all /20">Confirm Booking</button>
 </div>
 </form>
 </div>
</div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\appointments\index.blade.php ENDPATH**/ ?>