<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
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
            Category::insert(
                [
                    'category_name' => $faker->word(),
                    'created_at'    => now()->toDateTimeString(),
                    'updated_at'    => now()->toDateTimeString(),
                ]
            );
        }
    }
}
