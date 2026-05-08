<aside class="w-72 glass-panel border-r border-white/5 flex flex-col h-screen sticky top-0" style="width:288px;min-width:288px">
    <div class="p-8 pb-4">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-indigo-500 rounded-[1rem] flex items-center justify-center shadow-[0_0_15px_rgba(99,102,241,0.5)]">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/><path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div>
                <h1 class="text-lg font-black text-white tracking-tighter uppercase">Opeshis OS</h1>
                <p class="text-[8px] font-black text-slate-500 uppercase tracking-widest">Universal Healthcare Core</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 pb-4 space-y-0.5 no-scrollbar">
        <?php
        $userRole = auth()->user()->role ?? 'Guest';
        $userPermissions = \Illuminate\Support\Facades\Cache::remember("sidebar_perms_v3_{$userRole}", 60, function() use ($userRole) {
            if (in_array($userRole, ['Admin', 'SuperAdmin', 'System Core'])) {
                return ['all'];
            }
            return \Illuminate\Support\Facades\DB::table('sys_role_permissions')
                ->where(\Illuminate\Support\Facades\DB::raw('TRIM(LOWER(role_name))'), trim(strtolower($userRole)))
                ->pluck('permission_code')
                ->toArray();
        });

        $hasPerm = function($perm) use ($userPermissions) {
            if (in_array('all', $userPermissions)) return true;
            return in_array($perm, $userPermissions);
        };

        $nav = function($href, $label, $pattern) {
            $active = request()->is(ltrim($pattern,'/').'*') || request()->is(ltrim($href,'/'));
            $cls = $active
                ? 'bg-indigo-500 text-white shadow-[0_0_10px_rgba(99,102,241,0.3)]'
                : 'text-slate-400 hover:text-white hover:bg-white/5';
            return "<a href=\"{$href}\" class=\"flex items-center px-3 py-2 text-xs font-bold rounded-xl {$cls} transition-all\">{$label}</a>";
        };
        ?>

        
        <p class="px-3 pt-4 pb-2 text-[8px] font-black text-slate-400 uppercase tracking-widest">Main Navigation</p>
        <?php echo $nav('/dashboard','Hospital Dashboard','dashboard'); ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_patients') || $hasPerm('core_admin')): ?>
            <?php echo $nav('/patients','Patient Registry','patients'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_appointments') || $hasPerm('core_admin')): ?>
            <?php echo $nav('/appointments','Appointments','appointments'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_messaging') || $hasPerm('core_admin')): ?>
            <?php echo $nav('/messaging','Messaging & Alerts','messaging'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_clinical') || $hasPerm('module_vitals') || $hasPerm('module_emergency') || $hasPerm('module_maternal') || $hasPerm('module_paeds') || $hasPerm('module_chronic') || $hasPerm('module_telemedicine') || $hasPerm('core_admin')): ?>
            <p class="px-3 pt-5 pb-2 text-[8px] font-black text-slate-400 uppercase tracking-widest">Clinical Services</p>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_clinical') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/emr','Consultations (EMR)','emr'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_vitals') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/triage','Triage & Vitals','triage'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_emergency') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/emergency','Emergency & Trauma','emergency'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_maternal') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/maternal','Maternal Health (ANC)','maternal'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_paeds') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/paeds','Pediatrics','paeds'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_chronic') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/ncd','Chronic Care (NCD)','ncd'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_telemedicine') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/telemedicine','Telemedicine Hub','telemedicine'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_pharmacy') || $hasPerm('module_lab') || $hasPerm('module_radiology') || $hasPerm('core_admin')): ?>
            <p class="px-3 pt-5 pb-2 text-[8px] font-black text-slate-400 uppercase tracking-widest">Diagnostics & Support</p>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_pharmacy') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/pharmacy','Pharmacy & Dispensary','pharmacy'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_lab') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/lab','Laboratory','lab'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_radiology') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/radiology','Radiology & Imaging','radiology'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_warehouse') || $hasPerm('module_assets') || $hasPerm('module_billing') || $hasPerm('core_admin')): ?>
            <p class="px-3 pt-5 pb-2 text-[8px] font-black text-slate-400 uppercase tracking-widest">Operations & Finance</p>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_warehouse') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/warehouse','Warehouse & Stock','warehouse'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_assets') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/assets','Asset Register','assets'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('module_billing') || $hasPerm('core_admin')): ?>
                <?php echo $nav('/billing','Billing & Finance','billing'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('core_admin') || $hasPerm('module_tech')): ?>
            <p class="px-3 pt-5 pb-2 text-[8px] font-black text-slate-400 uppercase tracking-widest">System Management</p>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('core_admin') || $hasPerm('module_tech')): ?>
                <?php echo $nav('/analytics','Data Analytics (BI)','analytics'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPerm('core_admin')): ?>
                <?php echo $nav('/admin','Hospital Admin','admin'); ?>

                <?php echo $nav('/settings','System Settings','settings'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </nav>

    <div class="p-6 border-t border-white/5 glass-panel">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-rose-500 hover:text-white transition-all shadow-lg shadow-rose-500/5">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>
"
<?php /**PATH C:\laragon\www\opeshis\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>