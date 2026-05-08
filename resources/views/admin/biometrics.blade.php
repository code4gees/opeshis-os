<x-cc-shell title='Opeshis OS'>
@section("title","Biometrics - Opeshis OS")

<div class="space-y-6 animate-fade-in">
    <div class="flex justify-between items-center mb-8 border-b border-white/10 pb-8">
        <div><h2 class="text-2xl font-black uppercase text-white">Biometric Enrollment</h2><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Fingerprint Enrollment &amp; Patient Identity Verification</p></div>
        <button onclick="document.getElementById('enrModal').classList.remove('hidden')" class="px-6 py-3 bg-slate-800 text-white rounded-xl font-bold text-xs shadow-lg hover:bg-slate-900 transition">+ Enroll Patient</button>
    </div>
    @if(session("success"))<div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold mb-6">{{ session("success") }}</div>@endif
    <div class="glass-panel rounded-[2.5rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
        <div class="px-10 py-6 border-b border-white/5 bg-slate-50/30"><h3 class="text-xs font-black text-white uppercase tracking-widest">Enrolled Patients — {{ $enrollments->count() }} records</h3></div>
        <table class="w-full text-left">
            <thead class="bg-white/5 text-[10px] font-black text-slate-400 uppercase tracking-widest"><tr><th class="px-10 py-5">Patient</th><th>Device</th><th>Enrolled</th><th class="text-right px-10">Status</th></tr></thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($enrollments as $e)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-10 py-5"><div class="text-sm font-black text-white">{{ $e->full_name }}</div><div class="text-[10px] text-slate-400 font-bold">{{ $e->medical_id }}</div></td>
                    <td class="text-xs font-bold text-slate-400">{{ $e->device_id ?? "—" }}</td>
                    <td class="text-xs font-bold text-slate-400">{{ \Carbon\Carbon::parse($e->created_at)->format("d M Y") }}</td>
                    <td class="px-10 py-5 text-right"><span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-black">Active</span></td>
                </tr>
                @endforeach
                @if($enrollments->isEmpty())<tr><td colspan="4" class="p-20 text-center text-slate-300 italic">No biometric enrollments.</td></tr>@endif
            </tbody>
        </table>
    </div>
</div>
<div id="enrModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-lg rounded-[2.5rem] p-12 shadow-2xl">
        <h3 class="text-xl font-black text-white mb-8 uppercase">Enroll Patient Biometrics</h3>
        <form method="POST" action="{{ url("/admin/biometrics/enroll") }}" class="space-y-5">
            @csrf
            <div><label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Patient (Medical ID)</label><input name="patient_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold outline-none"></div>
            <div><label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Device ID</label><input name="device_id" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold outline-none" placeholder="BIO-DEV-001"></div>
            <div><label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Fingerprint Template (Base64)</label><textarea name="template" rows="3" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold outline-none resize-none font-mono text-xs"></textarea></div>
            <div class="flex gap-4 mt-8"><button type="button" onclick="document.getElementById('enrModal').classList.add('hidden')" class="flex-1 py-4 bg-white/10 text-slate-400 rounded-2xl text-xs font-black uppercase">Cancel</button><button type="submit" class="flex-1 py-4 bg-slate-800 text-white rounded-2xl text-xs font-black uppercase shadow-xl">Enroll</button></div>
        </form>
    </div>
</div>
</x-cc-shell>
