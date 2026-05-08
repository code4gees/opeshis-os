<?php
2: 
3: namespace App\Models;
4: 
5: use Illuminate\Database\Eloquent\Model;
6: use Illuminate\Database\Eloquent\Concerns\HasUuids;
7: 
8: class Department extends Model
9: {
10:     use HasUuids;
11: 
12:     protected $fillable = [
13:         'name',
14:         'code',
15:         'description'
16:     ];
17: 
18:     public function appointments()
19:     {
20:         return $this->hasMany(Appointment::class);
21:     }
22: }
