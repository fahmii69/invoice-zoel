<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

        for ($i = 0; $i < 15; $i++) {
            $product = Product::create(
                [
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'code'        => $faker->unique()->lexify('PDT-???????'),
                    'name'        => $faker->unique()->foodName(),
                    'buy_price'   => $faker->numerify('#000'),
                    'sale_price'  => $faker->numerify('##000'),
                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );

            foreach (range(1, Shop::count()) as $k) {
                Stock::create([
                    'product_id' => $product->id,
                    'shop_id'    => $k,
                    'quantity'   => $faker->randomNumber(2, false),
                ]);
            }
        }
    }
}
