<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Models\ContractDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as FacadesView;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class SaleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $title = 'Sale';
        return view('transactions.sale.index', compact('title'));
    }

    public function getSale(Request $request)
    {
        if ($request->ajax()) {
            $data = Sale::latest('id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product_list', function ($data) {
                    return $data->salesDetail->pluck('product_list')->toArray();
                })
                ->editColumn('customer_id', function ($data) {
                    // dd($data->category);
                    return $data->customer->name;
                })
                ->editColumn('sales_date', function ($data) {
                    return Carbon::parse($data->created_at)->format('d-M-Y');
                })
                ->addColumn('action', function ($data) {
                    $route = route('sale.edit', $data->id);
                    return view('components.sale-action-button', compact('data', 'route'));
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $title    = 'Add Sale';
        $action   = route('sale.store');
        $sale     = new Sale;
        $customer = Customer::get();
        $product  = Product::get();
        $editProduct = "";

        // $getSale = $sale->salesDetail;
        $addProduct = FacadesView::make('components.add-sale-product', compact('sale', 'product'));
        return view('transactions.sale.form', compact('product', 'title', 'customer', 'action', 'sale', 'addProduct', 'editProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSaleRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
        $pin = rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
        $string = str_shuffle($pin);
        $code = "SL-" . $string;
        try {

            $sale = new Sale($request->safe(
                ['sales_date', 'customer_id', 'sub_total',]
            ));

            $sale->code  = $code;
            $sale->grand_total  = $request->sub_total + $request->tax;
            $sale->save();

            for ($i = 0; $i < count($request->product_list); $i++) {
                $price    = str_replace(",", "", $request->sale_price[$i]);

                $saleDetail             = new  SaleDetail;
                $saleDetail->sales_id   = $sale->id;
                $saleDetail->product_id = $request->product_list[$i];
                $saleDetail->quantity = $request->quantity[$i];
                $saleDetail->price   = $price;
                $saleDetail->total   = $request->quantity[$i] * $price;
                $saleDetail->save();
            }

            $notification = array(
                'message'    => 'Sale data has been Added!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            DB::rollBack();
            $notification = array(
                'message'    => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification)->withInput();
        }
        DB::commit();
        return redirect()
            ->route('sale.index')
            ->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Sale $sale
     * @return View
     */
    public function edit(Sale $sale): View
    {
        $title    = 'Edit Sale';
        $action   = route('sale.update', $sale->id);
        $customer = Customer::get();
        $product  = Product::get();
        $addProduct = FacadesView::make('components.add-sale-product', compact('sale', 'product'));
        $editProduct = "";
        foreach ($sale->salesDetail as $getSale) {
            $editProduct .= FacadesView::make('components.edit-sale-product', compact('sale', 'getSale', 'product'));
        }

        return view('transactions.sale.form', compact('product', 'title', 'customer', 'action', 'sale', 'addProduct', 'editProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSaleRequest $request
     * @param  Sale $sale
     * @return RedirectResponse
     */
    public function update(UpdateSaleRequest $request, Sale $sale): RedirectResponse
    {
        DB::beginTransaction();


        try {

            $sale->fill($request->safe(
                ['sales_date', 'customer_id', 'sub_total',]
            ));


            $sale->grand_total  = $request->sub_total + $request->tax;
            $sale->update();

            SaleDetail::where('sales_id', $sale->id)->delete();
            for ($i = 0; $i < count($request->product_list); $i++) {
                $price    = str_replace(",", "", $request->sale_price[$i]);

                $saleDetail             = new  SaleDetail;
                $saleDetail->sales_id   = $sale->id;
                $saleDetail->product_id = $request->product_list[$i];
                $saleDetail->quantity = $request->quantity[$i];
                $saleDetail->price   = $price;
                $saleDetail->total   = $request->quantity[$i] * $price;
                $saleDetail->save();
            }

            $notification = array(
                'message'    => 'Sale data has been Added!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            DB::rollBack();
            $notification = array(
                'message'    => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification)->withInput();
        }
        DB::commit();
        return redirect()
            ->route('sale.index')
            ->with($notification);
    }

    /**
     * Delete data.
     *
     * @param Sale $sale
     * @return JsonResponse
     */
    public function destroy(Sale $sale): JsonResponse
    {
        Sale::destroy($sale->id);

        return response()->json(['success' => true, 'message' => 'Sale Data has been DELETED !']);
    }

    /**
     * get Contract Price.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getContractPrice(Request $request): JsonResponse
    {
        $response = [
            'status' => false,
            'data'   => [],
        ];

        try {
            $date       = $request->date;
            $customerId = $request->customerId;

            $contract = ContractDetail::query()
                ->select('product_id', 'price')
                ->whereHas('contract', function ($q) use ($date, $customerId) {
                    $q->where(function ($q) use ($date, $customerId) {
                        $q->where('start_date', '<=', $date)->where('end_date', '>=', $date);
                        $q->whereCustomerId($customerId);
                    });
                })
                ->groupBy('product_id')
                ->get();


            $response['data']   = $contract;
            $response['status'] = true;
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * export data to pdf.
     *
     * @param Sale $sale
     * @return void
     */
    public function pdf(Sale $sale)
    {
        $id       = $sale->id;
        $customer = $sale->customer->name;
        $date     = $sale->sales_date;

        $pdf = Pdf::loadView('transactions.sale.sample', compact('sale'));
        return $pdf->stream("invoice $id $customer $date.pdf");
    }
}
