<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Country;
use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{

    public function run(): void
    {
        $countryIds = Country::query()->pluck('id')->shuffle()->take(5)->toArray();
        $policies = [];
        foreach ($countryIds as $index => $countryId) {
            $policies[] = [
                'country_id' => $countryId,
                'admin_id' => Admin::query()->inRandomOrder()->first()->getAttribute('id'),
                'policy' => fake(locale: 'fa_IR')->realText(250),
                'is_active' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Policy::query()->insertOrIgnore($policies);
    }
}
