<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContractSeeder extends Seeder
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
            $contract = Contract::create(
                [
                    'customer_id' => Customer::inRandomOrder()->first()->id,
                    'start_date'  => Carbon::today()->subDays(rand(0, 30)),
                    'end_date'    => $faker->dateTimeInInterval('+4 week'),
                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );

            foreach (range(1, rand(1, 3)) as $k) {
                ContractDetail::create(
                    [
                        'contract_id' => $contract->id,
                        'product_id'  => Product::inRandomOrder()->first()->id,
                        'price'       => $faker->numerify('#000'),
                        'created_at'  => now()->toDateTimeString(),
                        'updated_at'  => now()->toDateTimeString(),
                    ]
                );
            }
        }
    }
}
