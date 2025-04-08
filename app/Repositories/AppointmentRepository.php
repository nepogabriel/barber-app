<?php

namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository
{
    public function createAppointments(array $appointments): bool
    {
        return Appointment::insert($appointments);
    }
}