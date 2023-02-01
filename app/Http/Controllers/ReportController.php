<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as FacadesView;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $this->title = 'Report';
        $this->customer = Customer::get();
        $this->product  = Product::get();
        $this->period = date('01-m-Y') . " - " . date('t-m-Y');

        $startDate = "2023-01-20";
        $endDate   = "2023-01-31";

        // dd($this->nama);

        $this->startDate = $startDate;
        $this->endDate   = $endDate;

        // $this->saleDetail = SaleDetail::query()
        //     ->select(DB::raw('SUM(quantity) as total_quantity'), 'product_id', 'sales_id')
        //     ->with('sale', 'product')
        //     ->whereHas('sale', function ($q) use ($startDate, $endDate) {
        //         $q->whereBetween('sales_date', [$startDate, $endDate]);
        //     })
        //     ->groupBy('product_id')
        //     ->get();

        // dd($saleDetail);

        // return view('master_data.report.index', compact('title', 'customer', 'product', 'period', 'saleDetail', 'startDate', 'endDate'));
        return view('master_data.report.index', $this->data);
    }

    /**
     * get Total Sales.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTotalSalesQuantity(Request $request): JsonResponse
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
                ->whereHas('sale', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('sales_date', [$startDate, $endDate]);
                })
                ->groupBy('product_id')
                ->get();

            $response['html']   = "";
            $response['html']   .= FacadesView::make('components.reports.breakdownsales', compact('saleDetail', 'startDate', 'endDate'));

            $response['data']   = $saleDetail;
            $response['status'] = true;
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Export data to excel.
     *
     * @param Request $request
     */
    public function export(Request $request)
    {

        $dateRange = $request->daterange;
        $date = explode(' - ', $dateRange);
        $startDate = $date[0];
        $endDate = $date[1];

        $carbonStart = Carbon::createFromFormat("d-m-Y", $startDate)->format('d-M-Y');
        $carbonEnd = Carbon::createFromFormat("d-m-Y", $endDate)->format('d-M-Y');

        // dd($carbonStart, $carbonEnd);
        return Excel::download(new ReportExport($startDate, $endDate), "Sales Report ($carbonStart to $carbonEnd).xlsx");
    }
}
