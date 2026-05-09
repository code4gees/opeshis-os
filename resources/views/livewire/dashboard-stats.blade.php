<div wire:poll.10s="refreshStats" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
 <x-cc-stat 
 label="Total Registrations" 
 :value="$stats['total_patients'] ?? 0" 
 icon="fa-hospital-user" 
 trend="+12% this week" 
 color="emerald" 
 />

 <x-cc-stat 
 label="Active Visits" 
 :value="$stats['active_visits'] ?? 0" 
 icon="fa-stethoscope" 
 trend="Live Queue" 
 color="emerald" 
 />

 <x-cc-stat 
 label="Ward Occupancy" 
 :value="$stats['active_admissions'] ?? 0" 
 icon="fa-bed-pulse" 
 trend="82% Capacity" 
 :trendUp="false"
 color="amber" 
 />

 <x-cc-stat 
 label="Pending Diagnostics" 
 :value="($stats['pending_labs'] ?? 0) + ($stats['pending_radiology'] ?? 0)" 
 icon="fa-microscope" 
 trend="Critical Action Needed" 
 :trendUp="false"
 color="rose" 
 />
</div>
