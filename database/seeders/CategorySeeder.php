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
        Category::insert([
            ['name'       => 'Additional'],
            ['name'       => 'Fruit'],
            ['name'       => 'Herb'],
            ['name'       => 'Vegetables'],
        ]);
    }
}
