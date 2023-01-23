<?php

use App\Models\Setting;

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        return Setting::whereName($key)->first()->value;
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $rupiah_result = "Rp " . number_format($angka, 0, ',', '.');
        return $rupiah_result;
    }
}
