<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_datetime',
        'status',
        'notes'
    ];

    // Relation to patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relation to doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Relation to services (pivot table)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_services')
            ->withPivot(['quantity', 'unit_price']) // if you want extra fields
            ->withTimestamps();
    }
}