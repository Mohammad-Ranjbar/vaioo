<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('fa_IR');
        $shipments = [];

        for ($i = 1; $i <= 50; $i++) {
            $shipments[] = [
                'trip_id' => rand(1, 5),
                'user_id' => rand(1, 10),
                'sender_name' => $faker->name(),
                'sender_phone' => $this->generatePersianPhoneNumber($faker),
                'reciver_name' => $faker->name(),
                'reciver_phone' => $this->generatePersianPhoneNumber($faker),
                'description' => $this->generatePersianDescription($faker),
                'weight' => rand(50, 5000) / 100,
                'declared_value' => rand(1000000, 50000000),
                'status' => $this->getRandomStatus(),
                'tracking_code' => $this->generateTrackingCode(),
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ];
        }

        DB::table('shipments')->insert($shipments);
    }

    private function generateTrackingCode(): string
    {
        return 'TRK' . strtoupper(Str::random(3)) . rand(100000, 999999);
    }

    private function getRandomStatus(): string
    {
        $statuses = ['pending', 'accepted', 'picked_up', 'in_transit', 'delivered'];
        $weights = [15, 10, 15, 25, 35];

        $random = rand(1, 100);
        $cumulative = 0;

        foreach ($weights as $index => $weight) {
            $cumulative += $weight;
            if ($random <= $cumulative) {
                return $statuses[$index];
            }
        }

        return 'pending';
    }

    private function generatePersianPhoneNumber($faker): string
    {
        return $faker->phoneNumber;
    }

    private function generatePersianDescription($faker): ?string
    {

        $descriptions = [
            'الکترونیک - fragile - با احتیاط حمل شود',
            'پوشاک و لوازم جانبی',
            'اسناد مهم - تا نشود',
            'کتاب و لوازم التحریر',
            'لوازم خانگی و دکوراسیون',
            'لوازم ورزشی',
            'لوازم پزشکی - فوری',
            'کالاهای فاسدشدنی - در دمای کنترل شده نگهداری شود',
            'قطعات یدکی خودرو',
            'لوازم اداری',
            'لوازم آرایشی و بهداشتی',
            'ابزار و سخت افزار',
            'اسباب بازی و بازی',
            'جواهرات - با ارزش',
            'اثر هنری - شکننده',
            'مواد غذایی',
            'لوازم دیجیتال',
            'مستندات شرکت',
            'نمونه محصول',
            'هدیه و سوغاتی'
        ];


        return $descriptions[array_rand($descriptions)];
    }
}