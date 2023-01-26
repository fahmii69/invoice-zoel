<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends BaseController
{
    /**
     * Dashboard Page Index.
     *
     * @return View
     */
    public function index(): View
    {
        $this->title    = "Dashboard";
        $this->product  = Product::get();
        $this->sale     = Sale::get();
        $this->customer = Customer::get();
        $this->supplier = Supplier::get();

        return view('dashboard.index', $this->data);
    }

    public function chart(Request $request)
    {
        // dd($request->all());
        $response = [
            'status' => false,
            'data'   => [],
        ];

        try {
            $startDate = $request->startDate;
            $endDate   = $request->endDate;

            $saleDetail = SaleDetail::query()
                ->select(DB::raw('SUM(quantity) as total_quantity'), 'product_id', 'sales_id')
                ->with('sale', 'product')
                ->join('sales', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('sales_date', [$startDate, $endDate]);
                    $q->on('sales.id', '=', 'sale_details.sales_id');
                })
                ->groupBy('sales.sales_date')
                ->get();

            // $saleDetail = SaleDetail::query()
            //     ->with('sale', 'sale.customer')
            //     ->select(DB::raw('SUM(quantity) as total_quantity'), 'product_id', 'sales_id')
            //     ->join('sales', function ($q) use ($startDate, $endDate) {
            //         $q->whereBetween('sales_date', [$startDate, $endDate]);
            //         $q->on('sales.id', '=', 'sale_details.sales_id');
            //     })
            //     ->whereProductId($productId)
            //     ->groupBy('product_id', 'sales.customer_id')
            //     ->get();

            $response['data']   = $saleDetail;
            $response['status'] = true;
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
