<x-cc-shell title='Opeshis OS'>
@section("title","Biometrics - Opeshis OS")

<div class="space-y-6 animate-fade-in">
 <div class="flex justify-between items-center mb-8 border-b border-subtle pb-8">
 <div><h2 class="text-2xl font-semibold uppercase text-white">Biometric Enrollment</h2><p class="text-[12px] font-bold text-slate-400 font-medium mt-1">Fingerprint Enrollment &amp; Patient Identity Verification</p></div>
 <button onclick="document.getElementById('enrModal').classList.remove('hidden')" class="px-6 py-3 bg-[#2a2e38] text-white rounded-xl font-bold text-xs hover:bg-card transition">+ Enroll Patient</button>
 </div>
 @if(session("success"))<div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold mb-6">{{ session("success") }}</div>@endif
 <div class="bg-card rounded-[2.5rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-6 border-b border-subtle bg-slate-50/30"><h3 class="text-xs font-semibold text-white font-medium">Enrolled Patients — {{ $enrollments->count() }} records</h3></div>
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium"><tr><th class="px-10 py-5">Patient</th><th>Device</th><th>Enrolled</th><th class="text-right px-10">Status</th></tr></thead>
 <tbody class="divide-y divide-slate-50">
 @foreach($enrollments as $e)
 <tr class="hover:bg-slate-50/50 transition">
 <td class="px-10 py-5"><div class="text-sm font-semibold text-white">{{ $e->full_name }}</div><div class="text-[12px] text-slate-400 font-bold">{{ $e->medical_id }}</div></td>
 <td class="text-xs font-bold text-slate-400">{{ $e->device_id ?? "—" }}</td>
 <td class="text-xs font-bold text-slate-400">{{ \Carbon\Carbon::parse($e->created_at)->format("d M Y") }}</td>
 <td class="px-10 py-5 text-right"><span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[12px] font-semibold">Active</span></td>
 </tr>
 @endforeach
 @if($enrollments->isEmpty())<tr><td colspan="4" class="p-20 text-center text-slate-300 ">No biometric enrollments.</td></tr>@endif
 </tbody>
 </table>
 </div>
</div>
<div id="enrModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-lg rounded-[2.5rem] p-12 ">
 <h3 class="text-xl font-semibold text-white mb-8 uppercase">Enroll Patient Biometrics</h3>
 <form method="POST" action="{{ url("/admin/biometrics/enroll") }}" class="space-y-5">
 @csrf
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Patient (Medical ID)</label><input name="patient_id" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none"></div>
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Device ID</label><input name="device_id" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none" placeholder="BIO-DEV-001"></div>
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Fingerprint Template (Base64)</label><textarea name="template" rows="3" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none resize-none font-mono text-xs"></textarea></div>
 <div class="flex gap-4 mt-8"><button type="button" onclick="document.getElementById('enrModal').classList.add('hidden')" class="flex-1 py-4 bg-white/10 text-slate-400 rounded-2xl text-xs font-semibold uppercase">Cancel</button><button type="submit" class="flex-1 py-4 bg-[#2a2e38] text-white rounded-2xl text-xs font-semibold uppercase ">Enroll</button></div>
 </form>
 </div>
</div>
</x-cc-shell>
