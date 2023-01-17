<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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

            // foreach (range(1, rand(1, 3)) as $k) {
            //     PeminjamanDetail::create([
            //         'buku_id'       => rand(1, 25),
            //         'peminjaman_id' => $peminjaman->id,
            //         'status'        => $faker->randomElements(['SEDANG_DIPINJAM', 'HILANG', 'DIKEMBALIKAN'])[0],
            //     ]);
            // }
        }
    }
}
