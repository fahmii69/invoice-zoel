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

class ContractController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $route = "contract.",
        protected string $routeView = "master_data.contract.",
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
        $this->title = 'Contract';
        return view($this->routeView . "index", $this->data);
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
                    return $data->contractDetail->pluck('contract_price')->toArray();
                })
                ->editColumn('start_date', function ($data) {
                    return Carbon::parse($data->start_date)->format('d-M-Y');
                })
                ->editColumn('end_date', function ($data) {
                    return Carbon::parse($data->end_date)->format('d-M-Y');
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
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        $this->title       = 'Add Contract';
        $this->action      = route($this->route . 'store');
        $this->contract    = new Contract;
        $this->customer    = Customer::get();
        $this->product     = Product::get();
        $this->editProduct = "";

        $this->addProduct = FacadesView::make('components.add-contract-product', $this->data);

        if ($this->auth->can('contract.create')) {
            return view('master_data.contract.form', $this->data);
        } else {
            $notification = array(
                'message'    => "You didn't have access to this page 😝 !!!",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification)->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupplierRequest $request
     * @return RedirectResponse
     */
    public function store(StoreContractRequest $request): RedirectResponse
    {
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

            for ($i = 0; $i < count($request->product_list); $i++) {

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
        $this->contract = $contract;
        $this->title    = 'Edit Contract';
        $this->action   = route('contract.update', $contract->id);
        $this->customer = Customer::get();
        $this->product  = Product::get();
        $this->addProduct = FacadesView::make('components.add-contract-product', $this->data);
        $this->editProduct = "";
        foreach ($contract->contractDetail as $this->getContract) {
            $this->editProduct .= FacadesView::make('components.edit-contract-product', $this->data);
        }

        if ($this->auth->can('contract.edit')) {
            return view('master_data.contract.form', $this->data);
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

            ContractDetail::where('contract_id', $contract->id)->delete();
            for ($i = 0; $i < count($request->product_list); $i++) {

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
        if ($this->auth->can('contract.delete')) {
            Contract::destroy($contract->id);

            return response()->json(['success' => true, 'message' => 'Contract Data has been DELETED !']);
        } else {
            return response()->json(['success' => false, 'message' => "You didn't have access for this action 😝 !!!"]);
        }
    }
}
