<?php

<<<<<<< HEAD:medxpert/app/Models/DoctorDetails.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
namespace App\Models\admin;

use App\Models\admin\Doctor;
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea:medxpert/app/Models/admin/DoctorDetails.php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'specialty',
        'clinic_address',
        'city',
        'price',
        'phone',
        'experience_years',
        'image',
        'rating',
    ];

<<<<<<< HEAD:medxpert/app/Models/DoctorDetails.php
=======
    /**
     * Get the doctor that owns these details.
     */
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea:medxpert/app/Models/admin/DoctorDetails.php
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
<<<<<<< HEAD:medxpert/app/Models/DoctorDetails.php
=======
    // In Doctor model
public function doctorDetails()
{
    return $this->hasOne(DoctorDetails::class);
}

>>>>>>> f07bc98923b74382b670049a39a542fa90369dea:medxpert/app/Models/admin/DoctorDetails.php
}