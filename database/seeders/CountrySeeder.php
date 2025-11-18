<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{

    public function run(): void
    {

        $countries = [
            ['code'=>'IR','name_en'=>'Iran','name_fa'=>'ایران'],
            ['code'=>'TU','name_en'=>'Turkey','name_fa'=>'ترکیه'],
            ['code'=>'MU','name_en'=>'Oman','name_fa'=>'عمان'],
        ];


        $countries = array_map(fn($row) => array_merge($row, [
            'created_at' => now(),
            'updated_at' => now(),
        ]), $countries);
        Country::query()->insertOrIgnore($countries);
    }
}
