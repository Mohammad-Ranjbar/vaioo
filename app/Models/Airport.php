<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_fa',
        'name_en',
        'code',
        'is_active',
        'country_id',
    ];
}
