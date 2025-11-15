<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family',
        'mobile',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function fullName(): Attribute
    {
        return Attribute::get(fn () => $this->getAttribute('name').' ' .$this->getAttribute('family'));
    }
}
