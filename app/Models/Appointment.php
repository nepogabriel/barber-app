<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'service_id',
        'datetime',
        'hour_id',
        'name_client',
        'telephone_cliente',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}
