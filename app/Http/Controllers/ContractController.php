<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contract\StoreContractRequest;
use App\Http\Requests\Contract\UpdateContractRequest;
use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\View as FacadesView;

class ContractController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $title = "Contract",
        protected string $route = "contract.",
        protected string $routeView = "master_data.contract.",
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view($this->routeView . "index", [
            'title'    => $this->title,
        ]);
    }

    public function getContract(Request $request)
    {
        if ($request->ajax()) {
            $data = Contract::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('customer_id', function ($data) {
                    return $data->customer->name;
                })
                ->addColumn('contract_product', function ($data) {
                    return $data->contractDetail->pluck('contract_product')->toArray();
                })
                ->addColumn('contract_price', function ($data) {
                    return $data->contractDetail->pluck('price')->toArray();
                })
                ->addColumn('action', function ($data) {
                    $route = route('contract.edit', $data->id);
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
        $title    = 'Add Contract';
        $action   = route('contract.store');
        $contract     = new Contract;
        $customer = Customer::get();
        $product  = Product::get();
        $editProduct = "";

        $addProduct = FacadesView::make('components.add-contract-product', compact('contract', 'product'));
        return view('master_data.contract.form', compact('product', 'title', 'customer', 'action', 'contract', 'addProduct', 'editProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupplierRequest $request
     * @return RedirectResponse
     */
    public function store(StoreContractRequest $request): RedirectResponse
    {

        // dd($request->all());

        DB::beginTransaction();

        try {

            $dateRange = $request->daterange;
            $date = explode(' - ', $dateRange);
            $startDate = $date[0];
            $endDate = $date[1];

            $carbonStart = Carbon::createFromFormat("d/m/Y", $startDate)->format('Y-m-d');
            $carbonEnd = Carbon::createFromFormat("d/m/Y", $endDate)->format('Y-m-d');

            $contract = new Contract($request->safe(
                ['customer_id']
            ));
            $contract->start_date = $carbonStart;
            $contract->end_date   = $carbonEnd;
            $contract->save();

            // dd($contract);
            for ($i = 0; $i < count($request->product_list); $i++) {

                // dd($request->product_list[$i]);
                $contractDetail              = new  ContractDetail;
                $contractDetail->contract_id = $contract->id;
                $contractDetail->product_id  = $request->product_list[$i];
                $contractDetail->price       = $request->price[$i];
                $contractDetail->save();
            }

            $notification = array(
                'message'    => 'Contract data has been added!',
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
     * @param Contract $contract
     * @return View
     */
    public function edit(Contract $contract)
    {
        $title    = 'Edit Contract';
        $action   = route('contract.update', $contract->id);
        $customer = Customer::get();
        $product  = Product::get();
        $addProduct = FacadesView::make('components.add-contract-product', compact('contract', 'product'));
        $editProduct = "";
        foreach ($contract->contractDetail as $getContract) {
            $editProduct .= FacadesView::make('components.edit-contract-product', compact('contract', 'getContract', 'product'));
        }

        return view('master_data.contract.form', compact('product', 'title', 'customer', 'action', 'contract', 'addProduct', 'editProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateContractRequest $request
     * @param  Contract $contract
     * @return RedirectResponse
     */
    public function update(UpdateContractRequest $request, Contract $contract): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $dateRange = $request->daterange;
            $date = explode(' - ', $dateRange);
            $startDate = $date[0];
            $endDate = $date[1];

            $carbonStart = Carbon::createFromFormat("d/m/Y", $startDate)->format('Y-m-d');
            $carbonEnd = Carbon::createFromFormat("d/m/Y", $endDate)->format('Y-m-d');

            $contract->fill($request->safe(
                ['customer_id']
            ));
            $contract->start_date = $carbonStart;
            $contract->end_date   = $carbonEnd;
            $contract->update();

            // dd($contract);

            ContractDetail::where('contract_id', $contract->id)->delete();
            for ($i = 0; $i < count($request->product_list); $i++) {

                // dd($request->product_list[$i]);
                $contractDetail              = new  ContractDetail;
                $contractDetail->contract_id = $contract->id;
                $contractDetail->product_id  = $request->product_list[$i];
                $contractDetail->price       = $request->price[$i];
                $contractDetail->save();
            }

            $notification = array(
                'message'    => 'Contract data has been updated!',
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
     * @param Contract $contract
     * @return JsonResponse
     */
    public function destroy(Contract $contract): JsonResponse
    {
        Contract::destroy($contract->id);

        return response()->json(['success' => true, 'message' => 'Contract Data has been DELETED !']);
    }
}
