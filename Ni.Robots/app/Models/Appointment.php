<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specialty;
use App\Models\CancelledAppointment;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_date',
        'scheduled_time',
        'type',
        'description',
        'doctor_id',
        'patient_id',
        'specialty'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
    // Relación con el doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relación con el paciente
    // Appointment.php
public function patient()
{
    return $this->belongsTo(Paciente::class, 'patient_id');
}


    public function getScheduledTime12Attribute()
    {
        return (new Carbon($this->scheduled_time))
            ->format('g:i A');
    }

    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);
    }
}
