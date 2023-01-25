<?php

use App\Models\SaleDetail;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        return Setting::whereName($key)->first()->value;
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $rupiah_result = "Rp " . number_format($angka, 2, ',', '.');
        return $rupiah_result;
    }
}

if (!function_exists('getBreakdownSales')) {
    function getBreakdownSales($productId, $startDate, $endDate)
    {

        $saleDetail = SaleDetail::query()
            ->with('sale', 'sale.customer')
            ->select(DB::raw('SUM(quantity) as total_quantity'), 'product_id', 'sales_id')
            ->join('sales', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('sales_date', [$startDate, $endDate]);
                $q->on('sales.id', '=', 'sale_details.sales_id');
            })
            ->whereProductId($productId)
            ->groupBy('product_id', 'sales.customer_id')
            ->get();

        return $saleDetail;
    }
}
