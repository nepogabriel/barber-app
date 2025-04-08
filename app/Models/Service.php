<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function Appointment()
    {
        return $this->hasMany(Appointment::class , 'service_id', 'id');
    }

    // protected function price(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (float $value): string => str_replace('.', ',', $value),
    //         set: function (string $value) {
    //             $new_value = preg_replace('/[^\d,]/', '', $value);
    //             $new_value = str_replace(',', '.', $new_value);

    //             return number_format((float) $new_value, 2, '.', '');
    //         },
    //     );
    // }
}
