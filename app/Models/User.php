<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'family',
        'mobile',
        'email',
        'password',
        'mobile_verified_at',
        'is_active'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function fullname(): Attribute
    {
        return Attribute::get(function () {
            $name = $this->getAttribute('name');
            $family = $this->getAttribute('family');

            if (!empty($name) && !empty($family)) {
                return $name . ' ' . $family;
            }

            return $this->getAttribute('mobile');
        });
    }

    protected function casts(): array
    {
        return [
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
