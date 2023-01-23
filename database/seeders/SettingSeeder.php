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
            // [
            //     'name'  => 'nominal_denda',
            //     'description' => 'Denda Terlambat',
            //     'value' => '15000',
            // ],
        ]);
    }
}
