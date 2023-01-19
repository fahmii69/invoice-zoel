<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::insert([
            [
                'name'       => 'ZoelStore-1',
                'address'    => 'Denpasar',
                'phone'      => '081937405027',
                'tax'        => 10,
                'currency'   => 'IDR',
                'pic'        => 'Komeng',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'name'       => 'ZoelStore-2',
                'address'    => 'Taban',
                'phone'      => '081337770323s',
                'tax'        => 5,
                'currency'   => 'IDR',
                'pic'        => 'Arman',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ]);
    }
}
