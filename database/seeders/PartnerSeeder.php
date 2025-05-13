<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $provinceId = 33;
        $regencyId = 3313;
        $districtId = 3313050;

        for ($i = 0; $i < 10; $i++) {
            DB::table('partners')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->numerify('8##########'),
                'province_id' => $provinceId,
                'regency_id' => $regencyId,
                'district_id' => $districtId,
                'address' => $faker->address,
                'group' => $faker->randomElement(['regular', 'star']),
                'is_access_product_dev' => $faker->boolean,
                'credit_limit' => $faker->numberBetween(5000000, 10000000),
                'blocked' => $faker->boolean,
                'password' => bcrypt('password'),
                'is_weak_password' => $faker->boolean,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
