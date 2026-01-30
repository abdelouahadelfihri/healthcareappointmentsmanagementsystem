<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function appointments()
    {
        return $this->belongsToMany(
            Appointment::class,
            'appointment_services'
        )->withPivot(['quantity', 'unit_price'])
            ->withTimestamps();
    }
}