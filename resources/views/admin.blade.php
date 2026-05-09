<x-cc-shell title='Opeshis OS'>

@section('title', 'Hospital Administration - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
 
 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">Hospital Administration</h1>
 <p class="text-sm text-slate-400 mt-1">Manage personnel, permissions, audit logs, and institutional pricing.</p>
 </div>
 <div class="mt-4 md:mt-0 flex items-center gap-4">
 <div class="text-right">
 <span class="block text-[12px] font-bold text-sage font-medium">System Governance</span>
 <span class="text-xs font-bold text-slate-300">Enterprise Mode</span>
 </div>
 <div class="w-px h-10 bg-slate-700"></div>
 <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
 </div>
 </header>

 <!-- Sub-Navigation -->
 <div class="flex flex-wrap border-b border-subtle gap-8 px-2">
 @php
 $subnav = function($sub, $label) use ($tab) {
 $active = $tab === $sub;
 $cls = $active ? 'text-sage border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300';
 $url = route('admin.index', ['subtab' => $sub]);
 return "<a href=\"{$url}\" class=\"pb-4 text-sm font-bold border-b-2 transition-all {$cls}\">{$label}</a>";
 };
 @endphp
 {!! $subnav('users', 'User Management') !!}
 {!! $subnav('permissions', 'Permissions') !!}
 {!! $subnav('forensics', 'Audit Logs') !!}
 {!! $subnav('sys_finance', 'Service Pricing') !!}
 </div>

 @if(session('success'))
 <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-sm font-medium flex items-center gap-3">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
 {{ session('success') }}
 </div>
 @endif

 @if ($tab === 'users')
 <!-- User Management -->
 <div class="bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40 flex justify-between items-center">
 <h3 class="text-sm font-bold text-slate-200">Registered Personnel</h3>
 <button onclick="document.getElementById('userAddModal').classList.remove('hidden')" class="px-4 py-2 bg-sage hover:bg-sage text-white text-xs font-bold rounded-lg transition-all /10">Add Staff Member</button>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold uppercase text-[12px] tracking-wider">Name & Contact</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px] tracking-wider">Role / Department</th>
 <th class="px-6 py-5 font-semibold text-center uppercase text-[12px] tracking-wider">Status</th>
 <th class="px-8 py-5 text-right uppercase text-[12px] tracking-wider">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 @foreach($users as $u)
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-5">
 <div class="font-bold text-white uppercase text-xs">{{ $u->name }}</div>
 <div class="text-[12px] text-slate-500 mt-1">{{ $u->email }}</div>
 </td>
 <td class="px-6 py-5">
 <div class="text-xs font-bold text-sage uppercase">{{ $u->role }}</div>
 <div class="text-[12px] text-slate-500 mt-1 uppercase">{{ $u->department_name ?? 'General Pool' }}</div>
 </td>
 <td class="px-6 py-5 text-center">
 <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded text-[12px] font-bold uppercase">Active</span>
 </td>
 <td class="px-8 py-5 text-right">
 <button class="text-slate-400 hover:text-white transition-colors">Edit</button>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 <div class="p-6 border-t border-subtle bg-card/20">{{ $users->links() }}</div>
 </div>

 @elseif ($tab === 'permissions')
 <!-- Permissions Matrix -->
 <div class="flex flex-col lg:flex-row gap-8">
 <div class="w-full lg:w-72 space-y-2">
 <label class="text-[12px] font-bold text-slate-500 font-medium px-4 block mb-4">Select Role</label>
 @foreach($roles as $role)
 <a href="{{ route('admin.index', ['subtab' => 'permissions', 'role' => $role->name]) }}" class="block px-6 py-4 rounded-lg text-xs font-bold uppercase border transition-all {{ $selectedRole === $role->name ? 'bg-sage text-white border-blue-500 /20' : 'text-slate-400 border-subtle hover:bg-slate-700/40' }}">
 {{ $role->name }}
 </a>
 @endforeach
 </div>

 <div class="flex-1 bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40">
 <h3 class="text-sm font-bold text-slate-200">
 Permissions for: <span class="text-sage">{{ $selectedRole }}</span>
 </h3>
 </div>
 <div class="p-8 space-y-10">
 @foreach($permissions->groupBy('category') as $category => $perms)
 <div class="space-y-6">
 <h4 class="text-[12px] font-bold text-slate-500 font-medium flex items-center gap-4">
 {{ $category }}
 <div class="h-px flex-1 bg-slate-700/60"></div>
 </h4>
 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
 @foreach($perms as $p)
 <div class="flex items-center justify-between p-5 bg-card/40 border border-subtle rounded-xl group hover:border-blue-500/30 transition-all">
 <div class="max-w-[75%]">
 <p class="text-xs font-bold text-slate-200 uppercase group-hover:text-sage transition-colors">{{ $p->name }}</p>
 <p class="text-[12px] text-slate-500 mt-1 leading-relaxed">{{ $p->description }}</p>
 </div>
 <label class="relative inline-flex items-center cursor-pointer">
 <input type="checkbox" class="sr-only peer" {{ in_array($p->code, $rolePerms) ? 'checked' : '' }} onchange="togglePerm('{{ $p->code }}', this)">
 <div class="w-10 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-slate-400 after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sage after:"></div>
 </label>
 </div>
 @endforeach
 </div>
 </div>
 @endforeach
 </div>
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
 alert('Permission Error: ' + data.error);
 el.checked = !checked;
 }
 });
 }
 </script>

 @elseif ($tab === 'forensics')
 <!-- Audit Logs -->
 <div class="space-y-8">
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 @foreach($health as $key => $val)
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-2">{{ str_replace('_', ' ', $key) }}</p>
 <h4 class="text-2xl font-bold text-white">{{ $val }}</h4>
 </div>
 @endforeach
 </div>

 <div class="bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40 flex justify-between items-center">
 <h3 class="text-sm font-bold text-slate-200">System Activity Audit Logs</h3>
 <div class="flex gap-3">
 <form method="POST" action="{{ route('admin.action') }}">
 @csrf
 <input type="hidden" name="action" value="trigger_backup">
 <button type="submit" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-bold rounded-lg transition-colors border border-slate-600">Manual Backup</button>
 </form>
 </div>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold uppercase text-[12px]">Timestamp</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px]">User Actor</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px]">Action Performed</th>
 <th class="px-8 py-5 text-right uppercase text-[12px]">Source IP</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 @foreach($auditLogs as $log)
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-4 text-slate-500 text-[12px] font-bold uppercase">{{ \Carbon\Carbon::parse($log->created_at)->format('d M, H:i:s') }}</td>
 <td class="px-6 py-4">
 <div class="font-bold text-white uppercase text-[12px]">{{ $log->staff_name ?? 'System Process' }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] font-bold text-sage uppercase tracking-tight">{{ str_replace('_', ' ', $log->action) }}</div>
 <div class="text-[12px] text-slate-500 mt-1 ">Record: {{ $log->table_name }} ({{ substr($log->record_id, 0, 8) }}...)</div>
 </td>
 <td class="px-8 py-4 text-right font-mono text-[12px] text-slate-500">{{ $log->ip_address }}</td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 <div class="p-6 border-t border-subtle bg-card/20">{{ $auditLogs->links() }}</div>
 </div>
 </div>

 @elseif ($tab === 'sys_finance')
 <!-- Pricing Matrix -->
 <div class="bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40 flex justify-between items-center">
 <h3 class="text-sm font-bold text-slate-200">Institutional Service Catalog</h3>
 <button class="px-4 py-2 bg-sage hover:bg-sage text-white text-xs font-bold rounded-lg transition-all /10">Add Service</button>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold uppercase text-[12px]">Service Category</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px]">Service Description</th>
 <th class="px-8 py-5 text-right uppercase text-[12px]">Standard Rate</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 @foreach($tariffs as $t)
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-5">
 <span class="px-2 py-0.5 bg-card border border-slate-700 text-slate-400 rounded text-[12px] font-bold uppercase">{{ $t->category }}</span>
 </td>
 <td class="px-6 py-5 font-bold text-slate-200 uppercase text-xs">{{ $t->service_name }}</td>
 <td class="px-8 py-5 text-right font-bold text-emerald-500">
 <span class="text-[12px] text-slate-500 mr-1">FCFA</span>{{ number_format($t->base_price, 0) }}
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 <div class="p-6 border-t border-subtle bg-card/20">{{ $tariffs->links() }}</div>
 </div>
 @endif
</div>

<!-- Modal: Add Personnel -->
<div id="userAddModal" class="fixed inset-0 bg-card/80 z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-[#2a2e38] w-full max-w-2xl rounded-xl p-8 border border-subtle">
 <h3 class="text-xl font-bold text-white mb-8 uppercase flex items-center gap-3">
 <div class="w-2 h-2 bg-sage rounded-full animate-pulse"></div>
 Add Staff Member
 </h3>
 <form method="POST" action="{{ route('admin.action') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
 @csrf
 <input type="hidden" name="action" value="add_user">
 <div class="md:col-span-2">
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Full Legal Name</label>
 <input type="text" name="name" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 uppercase">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Email Address</label>
 <input type="email" name="email" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Initial Password</label>
 <input type="password" name="password" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">System Role</label>
 <select name="role" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 @foreach($roles as $role)
 <option value="{{ $role->name }}">{{ $role->name }}</option>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Department</label>
 <select name="sys_dept_id" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 @foreach($sysDepts as $d)
 <option value="{{ $d->id }}">{{ $d->name }}</option>
 @endforeach
 </select>
 </div>
 <div class="md:col-span-2 flex gap-3 pt-6">
 <button type="button" onclick="document.getElementById('userAddModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-3 bg-sage hover:bg-sage text-white rounded-lg text-sm font-bold transition-all /20">Create Personnel Node</button>
 </div>
 </form>
 </div>
</div>
</x-cc-shell>
