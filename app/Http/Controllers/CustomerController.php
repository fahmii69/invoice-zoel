<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CustomerController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $route = "customer.",
        protected string $routeView = "master_data.customer.",
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
        $this->title = 'Customer';
        return view($this->routeView . "index", $this->data);
    }

    public function getCustomer(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = route('customer.edit', $data->id);
                    return view('components.action-button', compact('data', 'route'));
                })
                ->editColumn('payment_terms', function ($data) {
                    if ($data->payment_terms > 0) {
                        return $data->payment_terms;
                    }
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
        $this->title    = "Add Customer";
        $this->customer = new Customer();
        $this->action   = route($this->route . 'store');

        if ($this->auth->can('customer.create')) {
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
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $customer = new Customer($request->safe(
                [
                    'name',
                    'address',
                    'state',
                    'province',
                    'postcode',
                    'country',
                    'work_phone',
                    'payment_terms',
                    'customer_type',
                    'send_reminders'
                ]
            ));

            $customer->save();

            $notification = array(
                'message'    => 'Customer data has been added!',
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
     * @param  Customer $customer
     * @return View|RedirectResponse
     */
    public function edit(Customer $customer): View|RedirectResponse
    {
        $this->title    = "Edit Customer";
        $this->customer = $customer;
        $this->action   = route($this->route . 'update', $customer);

        if ($this->auth->can('customer.edit')) {
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
     * @param  UpdateCustomerRequest $request
     * @param  Customer $customer
     * @return RedirectResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $customer->fill($request->safe(
                [
                    'name',
                    'address',
                    'state',
                    'province',
                    'postcode',
                    'country',
                    'work_phone',
                    'payment_terms',
                    'customer_type',
                    'send_reminders'
                ]
            ));

            $customer->update();

            $notification = array(
                'message'    => 'Customer data has been updated!',
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
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        if ($this->auth->can('customer.delete')) {
            Customer::destroy($customer->id);

            return response()->json(['success' => true, 'message' => 'Customer Data has been DELETED !']);
        } else {
            return response()->json(['success' => false, 'message' => "You didn't have access for this action 😝 !!!"]);
        }
    }
}
