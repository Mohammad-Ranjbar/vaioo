<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $users = [
            [
                'name' => 'Ali',
                'family' => 'Rezaei',
                'mobile' => '09121234567',
                'email' => 'ali.rezaei@example.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Sara',
                'family' => 'Mohammadi',
                'mobile' => '09121234568',
                'email' => 'sara.mohammadi@example.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Mohammad',
                'family' => 'Ahmadi',
                'mobile' => '09121234569',
                'email' => 'mohammad.ahmadi@example.com',
                'mobile_verified_at' => null,
                'is_active' => false,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Fatemeh',
                'family' => 'Hosseini',
                'mobile' => '09121234570',
                'email' => 'fatemeh.hosseini@example.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Reza',
                'family' => 'Jafari',
                'mobile' => '09121234571',
                'email' => 'reza.jafari@example.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Zahra',
                'family' => 'Kazemi',
                'mobile' => '09121234572',
                'email' => 'zahra.kazemi@example.com',
                'mobile_verified_at' => null,
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Amir',
                'family' => 'Naseri',
                'mobile' => '09121234573',
                'email' => 'amir.naseri@example.com',
                'mobile_verified_at' => now(),
                'is_active' => false,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Narges',
                'family' => 'Rahmani',
                'mobile' => '09121234574',
                'email' => 'narges.rahmani@example.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Hossein',
                'family' => 'Ghorbani',
                'mobile' => '09121234575',
                'email' => 'hossein.ghorbani@example.com',
                'mobile_verified_at' => null,
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Maryam',
                'family' => 'Farsi',
                'mobile' => '09121234576',
                'email' => 'maryam.farsi@example.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Mohammad',
                'family' => 'Ranjbar',
                'mobile' => '09126872183',
                'email' => 'm.ranjbar@gmail.com',
                'mobile_verified_at' => now(),
                'is_active' => true,
                'password' => Hash::make('09126872183'),
            ]
        ];
        $users = array_map(fn($user) => array_merge($user, [
            'created_at' => now(),
            'updated_at' => now(),
        ]),$users);
        DB::table('users')->insertOrIgnore($users);

    }
}
