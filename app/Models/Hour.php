<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value): string => Carbon::parse($value)->format('d/m/Y'),
        );
    }

    protected function time(): Attribute
    {
        return Attribute::make(
            get: fn ($value): string => Carbon::parse($value)->format('H:i'),
        );
    }
}
