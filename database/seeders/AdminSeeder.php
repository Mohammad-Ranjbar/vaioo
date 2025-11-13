<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'omid',
                'family' => 'maghani',
                'mobile' => '09123876457',
                'email' => 'maghani@vaioo.com',
                'password' => Hash::make('09123876457'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'mohammad',
                'family' => 'ranjbar',
                'mobile' => '09126872183',
                'email' => 'ranjbar@vaioo.com',
                'password' => Hash::make('09126872183'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
       Admin::query()->insertOrIgnore($admins);
    }
}
