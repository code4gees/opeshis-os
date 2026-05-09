<x-cc-shell title='Opeshis OS'>

@section('title', 'Patient Consultation - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-6 pb-20">
 
 <!-- Institutional Clinical Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-subtle pb-8">
 <div class="flex items-center gap-6">
 <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center border border-subtle text-3xl font-semibold text-white /20">
 {{ substr($encounter->full_name, 0, 1) }}
 </div>
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold font-medium text-slate-500 mb-2">
 <i class="fas fa-stethoscope text-sage/50"></i>
 <span>Clinical Command</span>
 <span class="text-white/10">/</span>
 <span class="text-slate-300">Live Consultation</span>
 </div>
 <h1 class="text-4xl font-semibold text-white tracking-tighter uppercase">
 {{ $encounter->full_name }}
 </h1>
 <div class="flex items-center gap-4 mt-2 text-[12px] font-bold font-medium">
 <span class="text-sage">{{ $encounter->medical_id }}</span>
 <span class="text-slate-600">|</span>
 <span class="text-slate-300">{{ $encounter->gender }}</span>
 <span class="text-slate-600">|</span>
 <span class="text-slate-300">{{ \Carbon\Carbon::parse($encounter->date_of_birth)->age }} Years Old</span>
 </div>
 </div>
 </div>
 <div class="mt-6 md:mt-0 flex gap-3">
 <x-cc-button variant="secondary" icon="fa-history" href="{{ route('clinical.dossier', $encounter->patient_id) }}">
 Full Dossier
 </x-cc-button>
 <form action="{{ route('emr.close') }}" method="POST" id="closeForm">
 @csrf
 <input type="hidden" name="encounter_id" value="{{ $encounterId }}">
 <x-cc-button type="button" icon="fa-check-double" onclick="finalizeSession()" class="bg-emerald-600 hover:bg-emerald-500">
 Finalize Session
 </x-cc-button>
 </form>
 </div>
 </div>

 @if(session('success'))
 <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-[12px] font-semibold font-medium animate-pulse">
 <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
 </div>
 @endif

 <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
 
 <!-- Main Documentation Engine (3 Columns) -->
 <div class="lg:col-span-3 space-y-6">
 
 <div class="cc-card rounded-2xl border border-subtle bg-card/50 overflow-hidden ">
 <!-- SOAP Navigation Architecture -->
 <div class="flex border-b border-subtle bg-card">
 @foreach(['subjective' => 'Subjective', 'objective' => 'Objective', 'assessment' => 'Assessment', 'plan' => 'Plan'] as $id => $label)
 <button onclick="setSoapTab('{{ $id }}')" id="btn-{{ $id }}" class="tab-btn {{ $id === 'subjective' ? 'active' : '' }} px-8 py-5 text-[12px] font-semibold font-medium transition-all border-b-2 border-transparent">
 {{ $label }}
 </button>
 @endforeach
 </div>
 
 <!-- Documentation Panels -->
 <div class="p-8 min-h-[500px]">
 <div id="soap-subjective" class="soap-panel">
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-history text-sage/50"></i>
 <span>Clinical History & Complaints</span>
 </div>
 <textarea id="subjective" oninput="syncInputs()" class="w-full h-96 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Document patient complaints and clinical history...">{{ $consult->subjective ?? '' }}</textarea>
 </div>
 
 <div id="soap-objective" class="soap-panel hidden">
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-microscope text-sage/50"></i>
 <span>Physical Examination Findings</span>
 </div>
 <textarea id="objective" oninput="syncInputs()" class="w-full h-96 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Document physical examination findings...">{{ $consult->objective ?? '' }}</textarea>
 </div>

 <div id="soap-assessment" class="soap-panel hidden space-y-8">
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-diagnoses text-sage/50"></i>
 <span>Clinical Impression & Diagnosis</span>
 </div>
 <textarea id="assessment" oninput="syncInputs()" class="w-full h-48 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Document working diagnosis...">{{ $consult->assessment ?? '' }}</textarea>
 </div>
 
 <x-cc-card title="ICD-11 Diagnostic Encoding" icon="fa-barcode">
 <div class="flex gap-4 mb-6">
 <div class="flex-1">
 <x-cc-input name="icdSearch" placeholder="Search codes (e.g. Malaria, COVID)..." icon="fa-search" />
 </div>
 <x-cc-button type="button" variant="secondary" onclick="addICD()" icon="fa-plus">
 Encode
 </x-cc-button>
 </div>
 <div id="icdList" class="flex flex-wrap gap-2">
 @foreach($icd10 as $code)
 <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-sage/10 text-sage border border-blue-500/20 rounded-xl text-[12px] font-semibold uppercase tracking-tight">
 {{ $code }} 
 <button class="hover:text-white transition-colors">✕</button>
 </span>
 @endforeach
 </div>
 </x-cc-card>
 </div>

 <div id="soap-plan" class="soap-panel hidden space-y-8">
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-clipboard-list text-sage/50"></i>
 <span>Management Protocol & Follow-up</span>
 </div>
 <textarea id="plan" oninput="syncInputs()" class="w-full h-48 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Outline treatment plan and follow-up instructions...">{{ $consult->plan ?? '' }}</textarea>
 </div>
 
 <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
 <x-cc-card title="Institutional Pharmacy Order" icon="fa-pills">
 <div id="prescList" class="space-y-3 mb-6">
 @foreach($prescriptions as $p)
 <div class="p-4 bg-card rounded-xl border border-subtle flex justify-between items-center group hover:border-blue-500/30 transition-all">
 <div>
 <div class="text-[12px] text-slate-200 font-semibold uppercase tracking-tight">{{ $p['drug'] }}</div>
 <div class="text-[12px] text-slate-500 font-bold uppercase mt-1">{{ $p['dose'] }}</div>
 </div>
 <button class="text-slate-600 hover:text-rose-500 transition-colors">✕</button>
 </div>
 @endforeach
 </div>
 <x-cc-button type="button" variant="ghost" class="w-full border-dashed border-subtle" onclick="addPresc()" icon="fa-plus">
 Add Medication
 </x-cc-button>
 </x-cc-card>
 
                <x-cc-card title="Diagnostic Investigations" icon="fa-microscope">
                    <textarea id="procedure_notes" oninput="syncInputs()" class="w-full h-32 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-4 text-xs font-bold text-slate-400 placeholder-slate-800 outline-none focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 transition-all resize-none " placeholder="Request labs or radiology scans...">{{ $consult->procedure_notes ?? '' }}</textarea>
                    <div class="mt-4 flex gap-2">
                        <button type="button" onclick="requestLab()" class="flex-1 py-2 bg-white/5 border border-white/10 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:text-sage transition-all">Request Lab</button>
                        <button type="button" onclick="requestRadiology()" class="flex-1 py-2 bg-white/5 border border-white/10 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:text-sage transition-all">Request X-Ray</button>
                    </div>
                </x-cc-card>
 </div>
 </div>
 </div>
 
 <!-- Forensic Command Strip -->
 <div class="p-6 bg-card border-t border-subtle flex justify-between items-center">
 <div class="text-[12px] font-semibold text-slate-500 font-medium flex items-center gap-2">
 <i class="fas fa-shield-check text-sage/50"></i>
 <span>End-to-End Encryption Active</span>
 </div>
 <x-cc-button onclick="submitSave()" icon="fa-cloud-upload">
 Synchronize Documentation
 </x-cc-button>
 </div>
 </div>
 </div>

 <!-- Clinical Intelligence Panel (1 Column) -->
 <div class="lg:col-span-1 space-y-6">
 
 <!-- Dynamic Vitals Pulse -->
 <x-cc-card title="Institutional Vitals" icon="fa-heart-pulse">
 <div class="grid grid-cols-2 gap-4">
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">BP Gauge</label>
 <div class="text-lg font-semibold text-white">120/80</div>
 <div class="text-[8px] font-bold text-emerald-500 mt-1 uppercase">Normal Range</div>
 </div>
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">Thermal</label>
 <div class="text-lg font-semibold text-emerald-500">36.8°C</div>
 <div class="text-[8px] font-bold text-slate-500 mt-1 uppercase">Febrile Negative</div>
 </div>
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">O2 Saturation</label>
 <div class="text-lg font-semibold text-sage">98%</div>
 <div class="text-[8px] font-bold text-sage/50 mt-1 uppercase">Ambient Air</div>
 </div>
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">Mass Index</label>
 <div class="text-lg font-semibold text-white">72.5 kg</div>
 <div class="text-[8px] font-bold text-slate-500 mt-1 uppercase">Target: 70kg</div>
 </div>
 </div>
 </x-cc-card>

 <!-- Forensic Alert Center -->
 <x-cc-card title="Clinical Risks" icon="fa-triangle-exclamation" class="border-rose-500/20">
 <div class="p-4 bg-rose-500/5 rounded-2xl border border-rose-500/10 text-xs font-bold text-rose-200">
 <i class="fas fa-hand-dots mr-2"></i>
 {{ $encounter->allergies ?: 'No Allergies Documented' }}
 </div>
 </x-cc-card>

 <!-- Longitudinal Timeline -->
 <x-cc-card title="Patient Timeline" icon="fa-timeline">
 <div class="space-y-6 relative">
 <div class="absolute left-2.5 top-2 bottom-2 w-px bg-[#2a2e38]"></div>
 
 <div class="pl-8 relative">
 <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-sage/10 border border-blue-500 flex items-center justify-center z-10 shadow-[0_0_15px_rgba(59,130,246,0.3)]">
 <div class="w-1.5 h-1.5 rounded-full bg-sage"></div>
 </div>
 <span class="text-[12px] font-semibold text-sage font-medium block">Active</span>
 <h4 class="text-xs font-semibold text-white uppercase mt-1">EMR Documentation</h4>
 <p class="text-[12px] font-medium text-slate-500 mt-1">Started {{ \Carbon\Carbon::parse($encounter->created_at)->format('H:i') }}</p>
 </div>
 
 <div class="pl-8 relative">
 <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-[#2a2e38] border border-slate-700 flex items-center justify-center z-10">
 <div class="w-1.5 h-1.5 rounded-full bg-slate-600"></div>
 </div>
 <span class="text-[12px] font-semibold text-slate-600 font-medium block">Genesis</span>
 <h4 class="text-xs font-semibold text-slate-500 uppercase mt-1">Record Initialized</h4>
 <p class="text-[12px] font-medium text-slate-700 mt-1 ">New institutional entry.</p>
 </div>
 </div>
 </x-cc-card>
 
 </div>
 </div>
</div>

<!-- Hidden Persistence Gateway -->
<form action="{{ route('emr.save') }}" method="POST" id="saveForm" class="hidden">
 @csrf
 <input type="hidden" name="encounter_id" value="{{ $encounterId }}">
 <input type="hidden" name="subjective" id="hidden_subjective">
 <input type="hidden" name="objective" id="hidden_objective">
 <input type="hidden" name="assessment" id="hidden_assessment">
 <input type="hidden" name="plan" id="hidden_plan">
 <input type="hidden" name="procedure_notes" id="hidden_procedure_notes">
 <input type="hidden" name="icd10" id="hidden_icd10">
 <input type="hidden" name="prescriptions" id="hidden_prescriptions">
</form>

<style>
 .tab-btn { color: rgba(148, 163, 184, 0.6); }
 .tab-btn.active { color: #3b82f6; border-color: #3b82f6; background-color: rgba(59, 130, 246, 0.05); text-shadow: 0 0 15px rgba(59, 130, 246, 0.4); }
 .tab-btn:hover:not(.active) { color: #cbd5e1; background-color: rgba(255, 255, 255, 0.02); }
 .soap-panel.hidden { display: none; }
</style>

<script>
 function setSoapTab(name) {
 document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
 document.getElementById('btn-' + name).classList.add('active');
 
 document.querySelectorAll('.soap-panel').forEach(p => p.classList.add('hidden'));
 document.getElementById('soap-' + name).classList.remove('hidden');
 }

  let icdCodes = {!! json_encode($icd10) !!};
  let prescriptions = {!! json_encode($prescriptions) !!};

  function addICD() {
  const input = document.getElementsByName('icdSearch')[0];
  const val = input.value.trim().toUpperCase();
  if (val && !icdCodes.includes(val)) {
  icdCodes.push(val);
  renderICD();
  input.value = '';
  }
  }

  function removeICD(code) {
  icdCodes = icdCodes.filter(c => c !== code);
  renderICD();
  }

  function renderICD() {
  const container = document.getElementById('icdList');
  container.innerHTML = icdCodes.map(c => `
  <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-sage/10 text-sage border border-blue-500/20 rounded-xl text-[12px] font-semibold uppercase tracking-tight">
  ${c} 
  <button type="button" onclick="removeICD('${c}')" class="hover:text-white transition-colors">✕</button>
  </span>
  `).join('');
  syncInputs();
  }

  function addPresc() {
  const drug = prompt("Drug Identity (e.g. PARACETAMOL 500MG):");
  if (!drug) return;
  const dose = prompt("Dosage Protocol (e.g. 1G TDS X 3 DAYS):");
  if (!dose) return;
  
  prescriptions.push({ drug, dose });
  renderPresc();
  }

  function removePresc(index) {
  prescriptions.splice(index, 1);
  renderPresc();
  }

  function renderPresc() {
  const container = document.getElementById('prescList');
  container.innerHTML = prescriptions.map((p, i) => `
  <div class="p-4 bg-card rounded-xl border border-subtle flex justify-between items-center group hover:border-blue-500/30 transition-all">
  <div>
  <div class="text-[12px] text-slate-200 font-semibold uppercase tracking-tight">${p.drug}</div>
  <div class="text-[12px] text-slate-500 font-bold uppercase mt-1">${p.dose}</div>
  </div>
  <button type="button" onclick="removePresc(${i})" class="text-slate-600 hover:text-rose-500 transition-colors">✕</button>
  </div>
  `).join('');
  syncInputs();
  }

  function requestLab() {
  const test = prompt("Institutional Lab Protocol (e.g. FBC, MP, LFT):");
  if (test) {
  const area = document.getElementById('procedure_notes');
  area.value += (area.value ? "\n" : "") + "LAB_REQUEST: " + test.toUpperCase();
  syncInputs();
  }
  }

  function requestRadiology() {
  const scan = prompt("Radiology Modality (e.g. CHEST X-RAY, PELVIC US):");
  if (scan) {
  const area = document.getElementById('procedure_notes');
  area.value += (area.value ? "\n" : "") + "RAD_REQUEST: " + scan.toUpperCase();
  syncInputs();
  }
  }

  function syncInputs() {
  document.getElementById('hidden_subjective').value = document.getElementById('subjective').value;
  document.getElementById('hidden_objective').value = document.getElementById('objective').value;
  document.getElementById('hidden_assessment').value = document.getElementById('assessment').value;
  document.getElementById('hidden_plan').value = document.getElementById('plan').value;
  document.getElementById('hidden_procedure_notes').value = document.getElementById('procedure_notes').value;
  document.getElementById('hidden_icd10').value = JSON.stringify(icdCodes);
  document.getElementById('hidden_prescriptions').value = JSON.stringify(prescriptions);
  }

  function submitSave() {
  syncInputs();
  document.getElementById('saveForm').submit();
  }

  function finalizeSession() {
  if(confirm("Institutional Protocol: Finalize this clinical session? The forensic record will be synchronized and locked.")) {
  document.getElementById('closeForm').submit();
  }
  }

  // Initialize synchronization
  syncInputs();
</script>
</x-cc-shell>
