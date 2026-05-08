<x-cc-shell title='Opeshis OS'>

@section('title', 'Dietary Command — Opeshis OS')


<div class="space-y-8 animate-fade-in">
    <!-- Header: Dietary Command Hub -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Dietary Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Nutrition Surveillance · Meal Logistics · Inpatient Regimen Matrix</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('planModal').classList.remove('hidden')" class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all border border-emerald-500/50">
                Authorize Meal Plan
            </button>
        </div>
    </header>

    <!-- Dietary Surveillance Matrix -->
    <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
        <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Live Delivery Surveillance Board</h3>
            <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Daily Sync: {{ now()->format('d M Y') }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Patient Protocol</th>
                        <th class="px-6 py-6">Regimen Matrix</th>
                        <th class="px-6 py-6">Clinical Restrictions</th>
                        <th class="px-6 py-6 text-center">Breakfast</th>
                        <th class="px-6 py-6 text-center">Lunch Matrix</th>
                        <th class="px-6 py-6 text-center">Dinner Matrix</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($activePlans as $p)
                    <tr class="hover:bg-white/5 transition-all group">
                        <td class="px-10 py-6">
                            <div class="font-black text-white text-sm uppercase group-hover:text-emerald-400 transition-colors">{{ $p->full_name }}</div>
                            <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">{{ $p->medical_id }}</div>
                        </td>
                        <td class="px-6 py-6">
                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest">{{ $p->meal_type }}</span>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-[10px] text-slate-400 italic max-w-xs truncate group-hover:whitespace-normal group-hover:overflow-visible transition-all">"{{ $p->restrictions ?: 'No documented clinical restrictions' }}"</div>
                        </td>
                        @foreach(['Breakfast', 'Lunch', 'Dinner'] as $meal)
                            @php 
                                $delivery = $p->deliveries->where('meal_name', $meal)->first();
                                $status = $delivery->meal_status ?? 'pending';
                            @endphp
                            <td class="px-6 py-6 text-center">
                                @if($status === 'delivered')
                                    <div class="w-10 h-10 bg-emerald-500/10 text-emerald-500 rounded-xl flex items-center justify-center mx-auto border border-emerald-500/20 shadow-lg shadow-emerald-500/5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                @elseif($status === 'npo')
                                    <div class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center mx-auto border border-rose-500/20 shadow-lg shadow-rose-500/5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    </div>
                                @else
                                    <button onclick="logMealDelivery('{{ $p->id }}', '{{ $meal }}')" class="w-10 h-10 bg-white/5 text-slate-500 rounded-xl flex items-center justify-center mx-auto hover:bg-indigo-500/20 hover:text-indigo-400 transition-all border border-white/10 hover:border-indigo-500/30">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/></svg>
                                    </button>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @if($activePlans->isEmpty())
                    <tr>
                        <td colspan="6" class="px-10 py-24 text-center">
                            <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active inpatient meal plans identified in the matrix.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Dietary Plan Authorization -->
<div id="planModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-8 uppercase tracking-tight">Regimen Assignment Protocol</h3>
        <form method="POST" action="{{ route('dietary.plan.store') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Institutional Admission ID</label>
                <input type="text" name="admission_id" required placeholder="ADM-XXXX-XXXX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Regimen Matrix Category</label>
                    <select name="meal_type" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        <option>General / Standard</option>
                        <option>Soft / Liquid</option>
                        <option>Diabetic Matrix</option>
                        <option>Renal Matrix</option>
                        <option>Low Sodium</option>
                        <option>Pediatric Protocol</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Clinical Restrictions</label>
                    <input type="text" name="restrictions" placeholder="e.g. PEANUT_ALLERGY" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Strategic Special Instructions</label>
                <textarea name="instructions" class="w-full h-24 bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar resize-none" placeholder="Provide strategic nutritional findings..."></textarea>
            </div>
            <div class="flex gap-4 mt-8">
                <button type="button" onclick="document.getElementById('planModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-emerald-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all border border-emerald-500/50">Establish Plan</button>
            </div>
        </form>
    </div>
</div>

<!-- Log Delivery Form (Hidden) -->
<form id="deliveryForm" method="POST" action="{{ route('dietary.delivery.log') }}" class="hidden">
    @csrf
    <input type="hidden" name="plan_id" id="form_plan_id">
    <input type="hidden" name="meal_name" id="form_meal_name">
    <input type="hidden" name="status" id="form_status">
</form>

<script>
    function logMealDelivery(planId, mealName) {
        if(confirm("AUTHORIZATION REQUIRED: Confirm delivery of " + mealName.toUpperCase() + "? (Cancel for NPO)")) {
            document.getElementById('form_status').value = 'delivered';
        } else {
            if(confirm("PROTOCOL WARNING: Mark as NPO (Nothing by Mouth)?")) {
                document.getElementById('form_status').value = 'npo';
            } else {
                return;
            }
        }
        document.getElementById('form_plan_id').value = planId;
        document.getElementById('form_meal_name').value = mealName;
        document.getElementById('deliveryForm').submit();
    }
</script>
</x-cc-shell>
