<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;

    protected $fillable = ['professional_id', 'date', 'time', 'checked'];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
