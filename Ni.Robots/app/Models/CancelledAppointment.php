<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledAppointment extends Model
{
    use HasFactory;

    // Relación con el usuario que cancela
    public function cancelled_by()
    {
        return $this->belongsTo(User::class, 'cancelled_by_id');
    }

    // Relación con la cita cancelada
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
