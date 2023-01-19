<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $title = 'Product';
        return view('master_data.product.index', compact('title'));
    }

    public function getProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest('id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_id', function ($data) {
                    // dd($data->category);
                    return $data->category->name;
                })
                ->addColumn('action', function ($data) {
                    $route = route('product.edit', $data->id);
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
        $title    = 'Add Product';
        $category = Category::get();
        $action   = route('product.store');
        $product  = new Product;

        return view('master_data.product.form', compact('title', 'category', 'action', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        // dd($request->all());

        $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
        $pin = rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
        $string = str_shuffle($pin);
        $code = "PDT-" . $string;

        try {

            $product = new Product($request->safe(
                ['name', 'category_id', 'sale_price', 'buy_price', 'image']
            ));

            $product->code  = $code;
            $product->save();

            for ($i = 1; $i < Shop::count() + 1; $i++) {
                $stock             = new Stock();
                $stock->product_id = $product->id;
                $stock->shop_id    = $i;
                $stock->quantity   = $request->current_inventory;
                $stock->save();
            }
            $notification = array(
                'message'    => 'Product data has been Added!',
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
            ->route('product.index')
            ->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $title  = 'Edit Product';
        $category = Category::get();
        $action   = route('product.update', $product->id);

        return view('master_data.product.form', compact('title', 'category', 'action', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest $request
     * @param  Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $product->fill($request->safe(
                ['name', 'category_id', 'sale_price', 'buy_price', 'image']
            ));

            $product->update();
            $notification = array(
                'message'    => 'Product data has been Updated!',
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
            ->route('product.index')
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        Product::destroy($product->id);

        return response()->json(['success' => true, 'message' => 'Product Data has been DELETED !']);
    }
}
