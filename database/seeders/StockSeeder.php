<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Stock::create(
                [
                    'product_id' => Product::inRandomOrder()->first()->id,
                    'shop_id'    => Shop::inRandomOrder()->first()->id,
                    'quantity'   => $faker->randomNumber(2, false),
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]
            );
        };
    }
}
