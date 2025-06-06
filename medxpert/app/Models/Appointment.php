<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id', 'id');
    }
<<<<<<< HEAD

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
=======
    public function slot()
    {
        return $this->belongsTo(AvailableSlot::class);
    }
}
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea
