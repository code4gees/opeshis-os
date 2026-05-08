<?php
2: 
3: namespace App\Models;
4: 
5: use Illuminate\Database\Eloquent\Model;
6: use Illuminate\Database\Eloquent\Concerns\HasUuids;
7: 
8: class PatientAppointmentRequest extends Model
9: {
10:     use HasUuids;
11: 
12:     protected $fillable = [
13:         'patient_id',
14:         'department_id',
15:         'preferred_date',
16:         'preferred_time',
17:         'reason',
18:         'status'
19:     ];
20: 
21:     public function patient()
22:     {
23:         return $this->belongsTo(Patient::class);
24:     }
25: 
26:     public function department()
27:     {
28:         return $this->belongsTo(Department::class);
29:     }
30: }
