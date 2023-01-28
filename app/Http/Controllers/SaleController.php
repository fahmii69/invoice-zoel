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
     * Constructor
     */
    public function __construct(
        protected string $route = "sale.",
        protected string $routeView = "transactions.sale.",

    ) {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $this->title = 'Sale';
        return view($this->routeView . "index", $this->data);
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
                    return $data->customer->name;
                })
                ->editColumn('sales_date', function ($data) {
                    return Carbon::parse($data->sales_date)->format('d-M-Y');
                })
                ->editColumn('due_date', function ($data) {
                    return Carbon::parse($data->due_date)->format('d-M-Y');
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
        $this->title    = 'Add Sale';
        $this->action   = route('sale.store');
        $this->sale     = new Sale;
        $this->customer = Customer::get();
        $this->product  = Product::get();
        $this->editProduct = "";
        $this->addProduct = FacadesView::make('components.add-sale-product', $this->data);

        return view($this->routeView . "form", $this->data);
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
                ['sales_date', 'due_date', 'customer_id', 'sub_total',]
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
            ->route($this->route . "index")
            ->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Sale $sale
     * @return View|RedirectResponse
     */
    public function edit(Sale $sale): View|RedirectResponse
    {
        $this->title       = 'Edit Sale';
        $this->sale        = $sale;
        $this->action      = route('sale.update', $sale->id);
        $this->customer    = Customer::get();
        $this->product     = Product::get();
        $this->addProduct  = FacadesView::make('components.add-sale-product', $this->data);
        $this->editProduct = "";
        foreach ($sale->salesDetail as $this->getSale) {
            $this->editProduct .= FacadesView::make('components.edit-sale-product', $this->data);
        }

        if ($this->auth->can('sale.edit')) {
            return view($this->routeView . "form", $this->data);
        } else {
            $notification = array(
                'message'    => "You didn't have access to this page 😝 !!!",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification)->withInput();
        }
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
                ['sales_date', 'due_date', 'customer_id', 'sub_total',]
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
            ->route($this->route . "index")
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
        if ($this->auth->can('sale.delete')) {
            Sale::destroy($sale->id);

            return response()->json(['success' => true, 'message' => 'Sale Data has been DELETED !']);
        } else {
            return response()->json(['success' => false, 'message' => "You didn't have access for this action 😝 !!!"]);
        }
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
        $code     = $sale->code;
        $customer = $sale->customer->name;
        $date     = $sale->sales_date;
        $getDate = Carbon::createFromFormat("Y-m-d", $date)->format('d-M-Y');

        $this->sale = $sale;

        // return view('transactions.sale.sample', $this->data);
        $pdf = Pdf::loadView('transactions.sale.receipt', $this->data);

        return $pdf->stream("invoice $code $customer $getDate.pdf");
    }
}
