<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_client',
        'logo_header',
        'favicon',
        'whatsapp',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
}
