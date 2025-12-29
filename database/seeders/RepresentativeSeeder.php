<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepresentativeSeeder extends Seeder
{
    public function run(): void
    {
        $representatives = [
            [
                'name' => 'امیر',
                'family' => 'محمدی',
                'national_code' => '0012345678',
                'passport_number' => 'A12345678',
                'email' => 'amir.mohammadi@example.com',
                'email_verified_at' => now(),
                'mobile' => '09121234567',
                'mobile_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'birth_date' => '1985-05-15',
                'verification_status' => 'approved',
                'verification_rejection_reason' => null,
                'verified_at' => now(),
                'rating_average' => 4.5,
                'rating_count' => 12,
            ],
            [
                'name' => 'سارا',
                'family' => 'رحمانی',
                'national_code' => '0012345679',
                'passport_number' => 'B12345678',
                'email' => 'sara.rahmani@example.com',
                'email_verified_at' => now(),
                'mobile' => '09121234568',
                'mobile_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'birth_date' => '1990-08-22',
                'verification_status' => 'approved',
                'verification_rejection_reason' => null,
                'verified_at' => now(),
                'rating_average' => 4.2,
                'rating_count' => 8,
            ],
            [
                'name' => 'رضا',
                'family' => 'جعفری',
                'national_code' => '0012345680',
                'passport_number' => 'C12345678',
                'email' => 'reza.jafari@example.com',
                'email_verified_at' => null,
                'mobile' => '09121234569',
                'mobile_verified_at' => null,
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'birth_date' => '1988-12-10',
                'verification_status' => 'pending',
                'verification_rejection_reason' => null,
                'verified_at' => null,
                'rating_average' => 0.00,
                'rating_count' => 0,
            ],
            [
                'name' => 'فاطمه',
                'family' => 'کریمی',
                'national_code' => '0012345681',
                'passport_number' => 'D12345678',
                'email' => 'fatemeh.karimi@example.com',
                'email_verified_at' => now(),
                'mobile' => '09121234570',
                'mobile_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'birth_date' => '1992-03-30',
                'verification_status' => 'rejected',
                'verification_rejection_reason' => 'مدارس هویت ناقص است',
                'verified_at' => null,
                'rating_average' => 3.8,
                'rating_count' => 5,
            ],
            [
                'name' => 'محمد جواد',
                'family' => 'رنجبر',
                'national_code' => '0017655444',
                'passport_number' => 'D12345679',
                'email' => 'ranjbar@example.com',
                'email_verified_at' => now(),
                'mobile' => '09126872183',
                'mobile_verified_at' => now(),
                'password' => Hash::make('09126872183'),
                'profile_image' => null,
                'birth_date' => '1994-12-08',
                'verification_status' => 'rejected',
                'verification_rejection_reason' => 'مدارس هویت ناقص است',
                'verified_at' => null,
                'rating_average' => 3.8,
                'rating_count' => 5,
            ],
            [
                'name' => 'حسین',
                'family' => 'اکبری',
                'national_code' => '0012345682',
                'passport_number' => 'E12345678',
                'email' => 'hossein.akbari@example.com',
                'email_verified_at' => now(),
                'mobile' => '09121234571',
                'mobile_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'birth_date' => '1987-07-18',
                'verification_status' => 'approved',
                'verification_rejection_reason' => null,
                'verified_at' => now(),
                'rating_average' => 4.8,
                'rating_count' => 15,
            ]
        ];
        $representatives = array_map(fn($representative) => array_merge($representative, [
            'created_at' => now(),
            'updated_at' => now(),
        ]), $representatives);
        DB::table('representatives')->insertOrIgnore($representatives);
    }
}
