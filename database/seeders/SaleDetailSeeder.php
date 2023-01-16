<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SaleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create('id_ID');

        // for ($i = 0; $i < 10; $i++) {
        //     $product = SaleDetail::create(
        //         [
        //             'sales_id'   => Sale::inRandomOrder()->first()->id,
        //             'product_id' => Product::inRandomOrder()->first()->id,
        //             'quantity'   => Stock::inRandomOrder()->first()->quantity,
        //             'price'      => $faker->numerify('##000'),
        //             'Total'      => $faker->numerify('###000'),
        //             'created_at' => now()->toDateTimeString(),
        //             'updated_at' => now()->toDateTimeString(),
        //         ]
        //     );
        // }
    }
}
