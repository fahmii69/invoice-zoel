<?php

namespace Database\Seeders;

use App\Models\Adjustment;
use App\Models\Shop;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdjustmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            Adjustment::create(
                [
                    'shop_id'         => Shop::inRandomOrder()->first()->id,
                    'supplier_id'     => Supplier::inRandomOrder()->first()->id,
                    'adjustment_date' => Carbon::today()->subDays(rand(0, 30)),
                    'created_at'      => now()->toDateTimeString(),
                    'updated_at'      => now()->toDateTimeString(),
                ]
            );
        }
    }
}
