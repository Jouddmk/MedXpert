<?php

<<<<<<< HEAD:medxpert/app/Models/patient.php
namespace App\Models;
=======
namespace App\Models\Admin;
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea:medxpert/app/Models/admin/Patient.php

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'gender',

    ];
    protected $casts = [
        'age' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicalHistory()
    {
<<<<<<< HEAD:medxpert/app/Models/patient.php
        return $this->hasOne(PatientMedicalHistory::class, 'user_id', 'id');
=======
        return $this->hasOne(PatientMedicalHistory::class, 'patient_id');
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea:medxpert/app/Models/admin/Patient.php
    }

    public function appointments()
    {
<<<<<<< HEAD:medxpert/app/Models/patient.php
        return $this->hasMany(Appointment::class, 'user_id', 'id');
=======
        return $this->hasMany(Appointment::class, 'patient_id');
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea:medxpert/app/Models/admin/Patient.php
    }
}