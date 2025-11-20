<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            [
                'name_fa' => 'فرودگاه بین‌المللی امام خمینی',
                'name_en' => 'Imam Khomeini International Airport',
                'code' => 'IKA',
                'is_active' => true,
                'country_id' => 1,

            ],
            [
                'name_fa' => 'فرودگاه مهرآباد',
                'name_en' => 'Mehrabad Airport',
                'code' => 'THR',
                'is_active' => true,
                'country_id' => 1,

            ],
            [
                'name_fa' => 'فرودگاه بین‌المللی دبی',
                'name_en' => 'Dubai International Airport',
                'code' => 'DXB',
                'is_active' => true,
                'country_id' => 2,

            ],
            [
                'name_fa' => 'فرودگاه آتاتورک استانبول',
                'name_en' => 'Istanbul Atatürk Airport',
                'code' => 'IST',
                'is_active' => true,
                'country_id' => 3,

            ],
        ];
        $airports = array_map(fn($airport) => array_merge($airport, [
            'created_at' => now(),
            'updated_at' => now(),
        ]),$airports);

            DB::table('airports')->insertOrIgnore($airports);

    }
}
