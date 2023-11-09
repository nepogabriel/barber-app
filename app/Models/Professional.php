<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'telephone', 'position'];

    public function AppAppointmentoiment()
    {
        return $this->hasMany(Appointment::class , 'professional_id', 'id');
    }
}
