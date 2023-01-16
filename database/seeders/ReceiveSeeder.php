<?php

namespace Database\Seeders;

use App\Models\Receive;
use App\Models\ReceiveDetail;
use App\Models\Shop;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReceiveSeeder extends Seeder
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
            $receive = Receive::create(
                [
                    'shop_id'      => Shop::inRandomOrder()->first()->id,
                    'supplier_id'  => Supplier::inRandomOrder()->first()->id,
                    'receive_date' => Carbon::today()->subDays(rand(0, 30)),
                    'notes'        => $faker->sentence(2),
                    'created_at'   => now()->toDateTimeString(),
                    'updated_at'   => now()->toDateTimeString(),
                ]
            );

            // foreach (range(1, rand(1, 3)) as $k) {
            //     ReceiveDetail::create([
            //         'buku_id'       => rand(1, 25),
            //         'peminjaman_id' => $peminjaman->id,
            //         'status'        => $faker->randomElements(['SEDANG_DIPINJAM', 'HILANG', 'DIKEMBALIKAN'])[0],
            //     ]);
            // }
        }
    }
}
