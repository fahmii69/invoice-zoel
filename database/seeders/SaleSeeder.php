<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Shop;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 15; $i++) {
            $sale = Sale::create(
                [
                    'customer_id' => Customer::inRandomOrder()->first()->id,
                    'sales_date'  => Carbon::today()->subDays(rand(0, 30)),
                    'code'        => $faker->unique()->lexify('SL-?????'),
                    'sub_total'   => $faker->numerify('###000'),
                    'grand_total' => $faker->numerify('###000'),
                    'notes'       => $faker->sentence(),
                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );

            foreach (range(1, rand(1, 3)) as $k) {
                SaleDetail::create(
                    [
                        'sales_id'   => $sale->id,
                        'product_id' => Product::inRandomOrder()->first()->id,
                        'quantity'   => Stock::inRandomOrder()->first()->quantity,
                        'price'      => $faker->numerify('##000'),
                        'Total'      => $faker->numerify('###000'),
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ]
                );
            }
        }
    }
}
