<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\StoreStockRequest;
use App\Http\Requests\Stock\UpdateStockRequest;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $title = 'Stock';

        return view('master_data.stock.index', compact('title'));
    }

    public function getStock(Request $request)
    {
        if ($request->ajax()) {
            $data = Stock::latest('id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('product_id', function ($data) {
                    return $data->product->name;
                })
                ->editColumn('shop_id', function ($data) {
                    return $data->shop->name;
                })
                ->addColumn('action', function ($data) {
                    $route = route('stock.edit', $data->id);
                    return view('components.action-button', compact('data', 'route'));
                })
                ->make(true);
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return View
    //  */
    // public function create(): View
    // {
    //     $title = 'Add Stock';
    //     $action = route('stock.store');
    //     $product = Product::get();
    //     $shop    = Shop::get();
    //     $stock = new Stock;

    //     return view('master_data.stock.form', compact('title', 'action', 'product', 'shop', 'stock'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  StoreStockRequest  $request
    //  * @return RedirectResponse
    //  */
    // public function store(StoreStockRequest $request): RedirectResponse
    // {
    //     DB::beginTransaction();

    //     try {
    //         $stock = new Stock($request->safe(
    //             ['product_id', 'shop_id', 'quantity']
    //         ));

    //         $stock->save();
    //         $notification = array(
    //             'message'    => 'Stock data has been Added!',
    //             'alert-type' => 'success'
    //         );
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $notification = array(
    //             'message'    => $e->getMessage(),
    //             'alert-type' => 'error'
    //         );

    //         return redirect()->back()->with($notification)->withInput();
    //     }
    //     DB::commit();
    //     return redirect()
    //         ->route('stock.index')
    //         ->with($notification);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Stock $stock
     * @return View
     */
    public function edit(Stock $stock): View
    {
        $title = 'Edit Stock';
        $action = route('stock.update', $stock->id);
        $product = Product::get();
        $shop    = Shop::get();

        return view('master_data.stock.form', compact('title', 'action', 'product', 'shop', 'stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStockRequest $request
     * @param  Stock $stock
     * @return RedirectResponse
     */
    public function update(UpdateStockRequest $request, Stock $stock): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $stock->fill($request->safe(
                ['product_id', 'shop_id', 'quantity']
            ));

            $stock->save();
            $notification = array(
                'message'    => 'Stock data has been Added!',
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
            ->route('stock.index')
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Stock $stock
     * @return JsonResponse
     */
    public function destroy(Stock $stock): JsonResponse
    {
        Stock::destroy($stock->id);

        return response()->json(['success' => true, 'message' => 'Stock Data has been DELETED !']);
    }
}
