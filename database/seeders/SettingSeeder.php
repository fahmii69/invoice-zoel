<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'name'  => 'jp_name',
                'value' => 'Jaya Perkasa Daily Fresh ',
            ],
            [
                'name'  => 'jp_address',
                'value' => 'Jalan Raya Sunset Road No 6 ',
            ],
            [
                'name'  => 'jp_state',
                'value' => 'Kuta - Bali ',
            ],
            [
                'name'  => 'jp_website',
                'value' => 'www.jayaperkasadailyfresh.com ',
            ],
            [
                'name'  => 'jp_email',
                'value' => 'sales@jayaperkasadailyfresh.com',
            ],
            [
                'name'  => 'jp_phone',
                'value' => '+62 821-4599-4317',
            ],
        ]);
    }
}
