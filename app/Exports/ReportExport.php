<?php

namespace App\Exports;

use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    public function __construct(
        public string $startDate,
        public string $endDate
    ) {
    }

    /**
     * Exporting data to excel.
     *
     * @return View
     */
    public function view(): View
    {
        $startDate = Carbon::createFromFormat("d-m-Y", $this->startDate)->format('Y-m-d') . " 00:00:00";
        $endDate   = Carbon::createFromFormat("d-m-Y", $this->endDate)->format('Y-m-d') . " 23:59:59";

        $data = SaleDetail::query()
            ->select(DB::raw('SUM(quantity) as total_quantity'), 'product_id', 'sales_id')
            ->with('sale', 'product')
            ->whereHas('sale', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('sales_date', [$startDate, $endDate]);
            })
            ->groupBy('product_id')
            ->get();

        return view('master_data.report.excel', compact('data', 'startDate', 'endDate'));
    }
}
