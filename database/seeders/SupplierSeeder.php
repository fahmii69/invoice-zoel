<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
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

            Supplier::insert(
                [
                    'name'       => $faker->company(),
                    'address'    => $faker->city(),
                    'phone'      => $faker->phoneNumber(),
                    'pic'        => $faker->name(),
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]
            );
        }
    }
}
