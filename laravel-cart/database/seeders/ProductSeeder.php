<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 3) as $index) {
            DB::table('products')->insert([
                'pdct_name' => $faker->word,
                'pdct_description' => $faker->sentence,
                'pdct_price' => $faker->randomFloat(2, 10, 100),
                'pdct_qty' => $faker->numberBetween(10, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
