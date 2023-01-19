<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as FacadesView;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
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
                ->editColumn('shop_id', function ($data) {
                    // dd($data->category);
                    return $data->shop->name;
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
                    return view('components.action-button', compact('data', 'route'));
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
        $shop     = Shop::get();
        $customer = Customer::get();
        $product  = Product::get();

        $addProduct = FacadesView::make('components.add-sale-product', compact('product'));
        return view('transactions.sale.form', compact('shop', 'product', 'title', 'customer', 'action', 'sale', 'addProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
