<x-cc-shell title='Opeshis OS'>

@section('title', 'Staff Credentialing & Licensing - Opeshis OS')

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Credentialing <span class="text-sage">& Licensing</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Personnel Licensure, Professional Certifications & Compliance Audits</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('auditModal').classList.remove('hidden')"
                class="cc-button-secondary flex items-center gap-2">
                <i class="fas fa-shield-check text-[10px]"></i>
                Run Expiry Audit
            </button>
            <button onclick="document.getElementById('addCredentialModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus-circle text-[10px]"></i>
                Enroll Credential
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Credentialing Telemetry Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <x-cc-stat 
            title="Total Registry" 
            value="{{ $staff->count() }}" 
            icon="fa-id-card" 
            trend="Staff Base" 
            color="slate" 
        />
        <x-cc-stat 
            title="Active Licenses" 
            value="{{ $staff->sum('credentials_count') - $expiredCount }}" 
            icon="fa-file-certificate" 
            trend="Compliance" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Expiring Soon" 
            value="{{ $expiringAlerts->count() }}" 
            icon="fa-bell-on" 
            trend="30-Day Window" 
            color="amber" 
        />
        <x-cc-stat 
            title="Expired Nodes" 
            value="{{ $expiredCount }}" 
            icon="fa-shield-exclamation" 
            trend="Action Required" 
            color="rose" 
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Personnel License Registry -->
        <div class="lg:col-span-8">
            <x-cc-card>
                <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                    <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                        <i class="fas fa-address-book text-sage text-[14px]"></i>
                        Personnel Licensure Registry
                    </h2>
                </div>

                <x-cc-table :headers="['Staff Profile Identity', 'License Matrix', 'Institutional Status', 'Audit']">
                    @forelse($staff as $s)
                        <tr class="group hover:bg-white/[0.01] transition-colors">
                            <td class="px-8 py-5">
                                <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $s->name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $s->role }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $s->credentials_count }} Registered Licenses</div>
                            </td>
                            <td class="px-8 py-5">
                                @if($s->expired_count > 0)
                                    <span class="px-3 py-1 rounded-lg bg-rose-500/10 text-rose-500 text-[9px] font-bold uppercase tracking-widest border border-rose-500/20">
                                        NON_COMPLIANT
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-lg bg-emerald-500/10 text-emerald-500 text-[9px] font-bold uppercase tracking-widest border border-emerald-500/20">
                                        COMPLIANT
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                                    <i class="fas fa-magnifying-glass-chart text-[10px]"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <i class="fas fa-ghost text-2xl text-white/10 mb-4 block"></i>
                                <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No personnel records identified.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Expiry Alert Matrix -->
        <div class="lg:col-span-4">
            <x-cc-card title="Expiry Alert Surveillance" icon="fa-shield-exclamation">
                <div class="p-8 space-y-6">
                    @forelse($expiringAlerts as $a)
                        <div class="p-5 bg-white/[0.02] border border-white/[0.04] rounded-2xl group hover:border-amber-500/30 transition-all">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h5 class="text-[11px] font-bold text-white uppercase tracking-tight group-hover:text-amber-500 transition-colors">{{ $a->user->name ?? 'UNKNOWN' }}</h5>
                                    <p class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $a->credential_type }}</p>
                                </div>
                                <span class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[8px] font-bold uppercase tracking-widest">
                                    EXPIRING
                                </span>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest">
                                    Expires: {{ \Carbon\Carbon::parse($a->expires_at)->format('d M Y') }}
                                </div>
                                <form method="POST" action="{{ route('admin.hr.credentialing.acknowledge', $a->id) }}">
                                    @csrf
                                    <button type="submit" class="text-[9px] font-bold text-sage uppercase tracking-widest hover:text-white transition-colors">Acknowledge</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No active expiry alerts identified.</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: Enroll Credential -->
<x-cc-modal id="addCredentialModal" title="Authorize Credential Enrollment" icon="fa-file-certificate">
    <form method="POST" action="{{ route('admin.hr.credentialing.store') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Institutional Personnel ID</label>
            <input name="user_id" required class="cc-input w-full" placeholder="e.g. PID-000000">
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Credential Protocol</label>
                <input name="type" required class="cc-input w-full" placeholder="e.g. MEDICAL_LICENSE">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Identifier Matrix</label>
                <input name="number" required class="cc-input w-full" placeholder="e.g. ML-12345-678">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Issuing Authority</label>
            <input name="issuing_body" required class="cc-input w-full" placeholder="e.g. NATIONAL_MEDICAL_COUNCIL">
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Temporal Issuance</label>
                <input name="issued_date" type="date" required class="cc-input w-full">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Temporal Expiry</label>
                <input name="expires_at" type="date" required class="cc-input w-full">
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="cc-button-primary w-full">Authorize Credential Transmission</button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Expiry Audit -->
<x-cc-modal id="auditModal" title="Authorize Expiry Surveillance Audit" icon="fa-shield-check">
    <div class="space-y-8">
        <p class="text-[12px] font-bold text-white/40 leading-relaxed uppercase tracking-widest">
            Warning: This protocol will conduct a system-wide audit of all personnel credentials and flag nodes nearing their temporal expiry limit. This action will be logged in the forensic activity stream.
        </p>
        <form method="POST" action="{{ route('admin.hr.credentialing.audit') }}">
            @csrf
            <button type="submit" class="cc-button-primary w-full">Authorize Audit Protocol</button>
        </form>
    </div>
</x-cc-modal>
</x-cc-shell>

