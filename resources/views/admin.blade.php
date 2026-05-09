<x-cc-shell title='Opeshis OS'>

@section('title', 'Hospital Administration - Opeshis OS')

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Governance <span class="text-sage">Control Plane</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Manage personnel, permissions, audit logs, and institutional pricing.</p>
        </div>
        <div class="flex gap-4">
            <div class="flex items-center gap-4 px-6 py-2 bg-white/5 border border-white/10 rounded-2xl">
                <div class="text-right">
                    <span class="block text-[10px] font-bold text-sage uppercase tracking-widest">Protocol: Secure</span>
                    <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Enterprise Mode</span>
                </div>
                <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_12px_rgba(16,185,129,0.4)] animate-pulse"></div>
            </div>
        </div>
    </div>

    <!-- Sub-Navigation -->
    <div class="flex flex-wrap border-b border-white/[0.04] gap-10 px-2 mb-10">
        @php
            $subnav = function($sub, $label) use ($tab) {
                $active = $tab === $sub;
                $cls = $active ? 'text-sage border-sage' : 'text-white/20 border-transparent hover:text-white transition-all';
                $url = route('admin.index', ['subtab' => $sub]);
                return "<a href=\"{$url}\" class=\"pb-4 text-[11px] font-bold uppercase tracking-[0.2em] border-b-2 transition-all {$cls}\">{$label}</a>";
            };
        @endphp
        {!! $subnav('users', 'Staff Registry') !!}
        <a href="{{ route('admin.hr.performance.index') }}" class="pb-4 text-[11px] font-bold uppercase tracking-[0.2em] border-b-2 transition-all text-white/20 border-transparent hover:text-white">Performance</a>
        <a href="{{ route('admin.hr.training.index') }}" class="pb-4 text-[11px] font-bold uppercase tracking-[0.2em] border-b-2 transition-all text-white/20 border-transparent hover:text-white">Training Hub</a>
        <a href="{{ route('admin.hr.credentialing.index') }}" class="pb-4 text-[11px] font-bold uppercase tracking-[0.2em] border-b-2 transition-all text-white/20 border-transparent hover:text-white">Licensing</a>
        {!! $subnav('permissions', 'Access Matrix') !!}
        {!! $subnav('forensics', 'Audit Forensics') !!}
        {!! $subnav('sys_finance', 'Tariff Catalog') !!}
    </div>

    @if(session('success'))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($tab === 'users')
        <!-- User Management -->
        <x-cc-card>
            <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                    <i class="fas fa-user-shield text-sage text-[14px]"></i>
                    Institutional Personnel Registry
                </h2>
                <button onclick="document.getElementById('userAddModal').classList.remove('hidden')"
                    class="cc-button-primary flex items-center gap-2">
                    <i class="fas fa-plus-circle text-[10px]"></i>
                    Authorize Staff
                </button>
            </div>

            <x-cc-table :headers="['Staff Profile', 'Role / Department', 'Status Matrix', 'Operations']">
                @foreach($users as $u)
                    <tr class="group hover:bg-white/[0.01] transition-colors">
                        <td class="px-8 py-5">
                            <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $u->name }}</div>
                            <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $u->email }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-[11px] font-bold text-sage uppercase tracking-widest">{{ $u->role }}</div>
                            <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $u->department_name ?? 'GENERAL_POOL' }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-lg bg-emerald-500/10 text-emerald-500 text-[9px] font-bold uppercase tracking-widest border border-emerald-500/20">
                                ACTIVE_NODE
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                                <i class="fas fa-pen-nib text-[10px]"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-cc-table>
            <div class="px-8 py-6 border-t border-white/[0.04] bg-white/[0.01]">
                {{ $users->links() }}
            </div>
        </x-cc-card>

    @elseif ($tab === 'permissions')
        <!-- Permissions Matrix -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-3 space-y-3">
                <label class="text-[10px] font-bold text-white/20 uppercase tracking-widest px-4 block mb-4">Select Governance Role</label>
                @foreach($roles as $role)
                    <a href="{{ route('admin.index', ['subtab' => 'permissions', 'role' => $role->name]) }}" 
                        class="flex items-center justify-between px-6 py-4 rounded-2xl text-[11px] font-bold uppercase tracking-widest border transition-all {{ $selectedRole === $role->name ? 'bg-sage text-[#1a1d24] border-sage shadow-[0_0_15px_rgba(130,192,154,0.2)]' : 'text-white/20 border-white/[0.04] hover:border-white/10 hover:text-white' }}">
                        {{ $role->name }}
                        @if($selectedRole === $role->name)
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="lg:col-span-9">
                <x-cc-card>
                    <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02]">
                        <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                            <i class="fas fa-key text-sage text-[14px]"></i>
                            Access Matrix: <span class="text-white">{{ $selectedRole }}</span>
                        </h3>
                    </div>
                    <div class="p-10 space-y-12">
                        @foreach($permissions->groupBy('category') as $category => $perms)
                            <div class="space-y-6">
                                <h4 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.3em] flex items-center gap-6">
                                    {{ $category }}
                                    <div class="h-px flex-1 bg-white/[0.04]"></div>
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($perms as $p)
                                        <div class="flex items-center justify-between p-6 bg-white/[0.02] border border-white/[0.04] rounded-2xl group hover:border-sage/20 transition-all">
                                            <div class="max-w-[75%]">
                                                <p class="text-[11px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $p->name }}</p>
                                                <p class="text-[10px] font-bold text-white/20 mt-2 leading-relaxed uppercase tracking-wider">{{ $p->description }}</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" class="sr-only peer" {{ in_array($p->code, $rolePerms) ? 'checked' : '' }} onchange="togglePerm('{{ $p->code }}', this)">
                                                <div class="w-10 h-6 bg-white/5 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white/20 after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sage after:shadow-sm"></div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-cc-card>
            </div>
        </div>

        <script>
            function togglePerm(code, el) {
                const checked = el.checked;
                const fd = new FormData();
                fd.append('_token', '{{ csrf_token() }}');
                fd.append('action', 'toggle_permission');
                fd.append('role', '{{ $selectedRole }}');
                fd.append('permission', code);
                fd.append('enabled', checked);

                fetch('{{ route('admin.action') }}', { method: 'POST', body: fd })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) {
                        alert('Governance Denial: ' + data.error);
                        el.checked = !checked;
                    }
                });
            }
        </script>

    @elseif ($tab === 'forensics')
        <!-- Audit Logs -->
        <div class="space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach($health as $key => $val)
                    <div class="cc-card p-8 flex flex-col justify-center">
                        <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">{{ str_replace('_', ' ', $key) }}</p>
                        <h4 class="text-3xl font-extrabold text-white tracking-tighter">{{ $val }}</h4>
                    </div>
                @endforeach
            </div>

            <x-cc-card>
                <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                    <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                        <i class="fas fa-shield-halved text-sage text-[14px]"></i>
                        Institutional Activity Audit Forensics
                    </h2>
                    <form method="POST" action="{{ route('admin.action') }}">
                        @csrf
                        <input type="hidden" name="action" value="trigger_backup">
                        <button type="submit" class="cc-button-secondary py-2 px-6">
                            Manual Backup
                        </button>
                    </form>
                </div>

                <x-cc-table :headers="['Temporal Log', 'User Actor', 'Action Intelligence', 'Source IP']">
                    @foreach($auditLogs as $log)
                        <tr class="hover:bg-white/[0.01] transition-colors">
                            <td class="px-8 py-5">
                                <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">
                                    {{ \Carbon\Carbon::parse($log->created_at)->format('d M, H:i:s') }}
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[12px] font-bold text-white uppercase tracking-tight">{{ $log->staff_name ?? 'SYSTEM_KERNEL' }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[11px] font-bold text-sage uppercase tracking-widest">{{ str_replace('_', ' ', $log->action) }}</div>
                                <div class="text-[10px] font-bold text-white/20 mt-1 uppercase tracking-widest">
                                    {{ $log->table_name }} ({{ substr($log->record_id, 0, 8) }}...)
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right font-mono text-[11px] text-white/20">
                                {{ $log->ip_address }}
                            </td>
                        </tr>
                    @endforeach
                </x-cc-table>
                <div class="px-8 py-6 border-t border-white/[0.04] bg-white/[0.01]">
                    {{ $auditLogs->links() }}
                </div>
            </x-cc-card>
        </div>

    @elseif ($tab === 'sys_finance')
        <!-- Pricing Matrix -->
        <x-cc-card>
            <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                    <i class="fas fa-file-invoice text-sage text-[14px]"></i>
                    Institutional Service Tariff Catalog
                </h2>
                <button class="cc-button-primary py-2 px-6">
                    Add Service
                </button>
            </div>

            <x-cc-table :headers="['Catalog Category', 'Service Intelligence', 'Standard Tariff']">
                @foreach($tariffs as $t)
                    <tr class="hover:bg-white/[0.01] transition-colors">
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-white/40 text-[9px] font-bold uppercase tracking-widest">
                                {{ $t->category }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-[12px] font-bold text-white uppercase tracking-tight">{{ $t->service_name }}</div>
                        </td>
                        <td class="px-8 py-5 text-right font-bold text-sage">
                            <span class="text-[10px] text-white/20 mr-2 uppercase tracking-widest">XAF</span>
                            <span class="text-[14px] tracking-tighter">{{ number_format($t->base_price, 0) }}</span>
                        </td>
                    </tr>
                @endforeach
            </x-cc-table>
            <div class="px-8 py-6 border-t border-white/[0.04] bg-white/[0.01]">
                {{ $tariffs->links() }}
            </div>
        </x-cc-card>
    @endif
</div>

<!-- Modal: Add Personnel -->
<x-cc-modal id="userAddModal" title="Authorize Staff Node" icon="fa-user-shield">
    <form method="POST" action="{{ route('admin.action') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @csrf
        <input type="hidden" name="action" value="add_user">
        <div class="md:col-span-2">
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Full Legal Name</label>
            <input type="text" name="name" required class="cc-input w-full" placeholder="e.g. DR. ALICE SMITH">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Institutional Email</label>
            <input type="email" name="email" required class="cc-input w-full" placeholder="alice@hospital.os">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Access Credential</label>
            <input type="password" name="password" required class="cc-input w-full" placeholder="••••••••">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Governance Role</label>
            <select name="role" required class="cc-input w-full">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Primary Department</label>
            <select name="sys_dept_id" required class="cc-input w-full">
                @foreach($sysDepts as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2 pt-6">
            <button type="submit" class="cc-button-primary w-full">Create Personnel Node</button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>
