<aside class="w-[240px] bg-sidebar flex flex-col h-screen sticky top-0 shrink-0">
 <div class="pt-8 pb-6 px-6">
 <div class="flex items-center gap-3">
 <div class="grid grid-cols-2 gap-0.5">
 <div class="w-2 h-2 rounded-sm bg-sage"></div>
 <div class="w-2 h-2 rounded-sm bg-slate-500"></div>
 <div class="w-2 h-2 rounded-sm bg-slate-500"></div>
 <div class="w-2 h-2 rounded-sm bg-sage"></div>
 </div>
 <h1 class="text-lg font-medium text-white tracking-wide">Hospital</h1>
 </div>
 </div>

 <nav class="flex-1 px-4 py-2 flex flex-col gap-2">
 <?php
 $nav = function($href, $label, $icon, $pattern) {
 $active = request()->is($pattern);
 $cls = $active
 ? 'bg-sage text-sidebar font-medium shadow-[#82c09a]/20'
 : 'text-slate-400 hover:text-white hover:bg-[#22262f] transition-colors';
 $iconCls = $active ? 'text-[#16191f]' : 'text-slate-500';
 $textCls = $active ? 'text-[#16191f]' : '';

 return "
 <a href=\"{$href}\" class=\"flex items-center gap-4 px-4 py-2.5 rounded-lg {$cls}\">
 <i class=\"fas {$icon} w-4 text-center text-sm {$iconCls}\"></i>
 <span class=\"text-[13px] {$textCls}\">{$label}</span>
 </a>";
 };
 ?>

     <?php echo $nav(route('dashboard'), 'Dashboard', 'fa-grip-vertical', 'dashboard'); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_patients')): ?>
        <?php echo $nav(route('patients.index'), 'Patients', 'fa-user-injured', 'registry/patients*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
        <?php echo $nav(route('emr.main'), 'Clinical Hub', 'fa-file-medical', 'clinical/emr*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_appointments')): ?>
        <?php echo $nav(route('appointments.index'), 'Appointments', 'fa-calendar-check', 'clinical/appointments*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
        <?php echo $nav(route('wards'), 'Inpatient Ward', 'fa-door-open', 'clinical/wards*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_paeds')): ?>
        <?php echo $nav(route('clinical.paeds.index'), 'Pediatrics', 'fa-baby', 'clinical/paeds*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_maternal')): ?>
        <?php echo $nav(route('clinical.obstetrics.index'), 'Obstetrics', 'fa-person-breastfeeding', 'clinical/obstetrics*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical') || auth()->user()->hasPermission('module_emergency')): ?>
        <div class="px-4 mt-4 mb-2">
            <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-2">Clinical Command</span>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
            <?php echo $nav(route('specialty.critical.icu.index'), 'ICU Command', 'fa-heart-pulse', 'specialty/critical-care/icu*'); ?>

            <?php echo $nav(route('specialty.critical.hdu.index'), 'HDU Command', 'fa-house-medical', 'specialty/critical-care/hdu*'); ?>

            <?php echo $nav(route('specialty.critical.nicu.index'), 'NICU Command', 'fa-baby-carriage', 'specialty/critical-care/nicu*'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_emergency')): ?>
            <?php echo $nav(route('clinical.emergency.index'), 'Emergency / A&E', 'fa-truck-medical', 'clinical/emergency*'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_pharmacy') || auth()->user()->hasPermission('module_lab') || auth()->user()->hasPermission('module_radiology') || auth()->user()->hasPermission('module_warehouse')): ?>
        <div class="px-4 mt-4 mb-2">
            <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-2">Diagnostics & Logistics</span>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_pharmacy')): ?>
            <?php echo $nav(route('operations.diagnostics.pharmacy.index'), 'Pharmacy', 'fa-pills', 'operations/diagnostics/pharmacy*'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_lab')): ?>
            <?php echo $nav(route('operations.diagnostics.lab.index'), 'Laboratory', 'fa-flask', 'operations/diagnostics/lab*'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_radiology')): ?>
            <?php echo $nav(route('operations.diagnostics.radiology.index'), 'Radiology', 'fa-x-ray', 'operations/diagnostics/radiology*'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_warehouse')): ?>
            <?php echo $nav(route('operations.supply.warehouse.index'), 'Warehouse', 'fa-warehouse', 'operations/supply-chain/warehouse*'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
        <div class="px-4 mt-4 mb-2">
            <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-2">Specialized Clinics</span>
        </div>
        <?php echo $nav(route('specialty.clinics.dental.index'), 'Dental Clinic', 'fa-tooth', 'specialty/clinics/dental*'); ?>

        <?php echo $nav(route('specialty.clinics.eye.index'), 'Eye Clinic', 'fa-eye', 'specialty/clinics/eye*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_billing')): ?>
        <?php echo $nav(route('finance.billing.index'), 'Billing & Revenue', 'fa-file-invoice-dollar', 'finance*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_admin')): ?>
        <div class="px-4 mt-4 mb-2">
            <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-2">Governance</span>
        </div>
        <?php echo $nav(route('admin.index'), 'Control Plane', 'fa-shield-halved', 'admin*'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



 <div class="mt-auto pb-4">
 <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
 <?php echo csrf_field(); ?>
 <button type="submit" class="w-full flex items-center gap-4 px-4 py-2.5 rounded-lg text-slate-400 hover:text-alert hover:bg-[#22262f] transition-colors text-left">
 <i class="fas fa-sign-out-alt w-4 text-center text-sm text-slate-500 group-hover:text-alert"></i>
 <span class="text-[13px]">Log out</span>
 </button>
 </form>
 </div>
 </nav>
</aside>
<?php /**PATH C:\laragon\www\opeshis\resources\views\partials\sidebar.blade.php ENDPATH**/ ?>