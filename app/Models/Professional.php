<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Professional extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telephone',
        'email',
        'password',
        'position',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function Appointment()
    {
        return $this->hasMany(Appointment::class , 'professional_id', 'id');
    }

    public function hour()
    {
        return $this->hasMany(Hour::class, 'professional_id', 'id');
    }
}
