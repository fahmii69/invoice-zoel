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

class CustomerController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $title = "Customer",
        protected string $route = "customer.",
        protected string $routeView = "master_data.customer.",
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
        return view($this->routeView . "form", [
            'title'    => "Add {$this->title}",
            'customer' => new Customer(),
            'action'   => route($this->route . 'store')
        ]);
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
                ['name', 'address', 'phone',]
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
     * @return View
     */
    public function edit(Customer $customer): View
    {
        return view($this->routeView . "form", [
            'title'    => "Edit {$this->title}",
            'customer' => $customer,
            'action'   => route($this->route . 'update', $customer)
        ]);
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
                ['name', 'address', 'phone',]
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
        Customer::destroy($customer->id);

        return response()->json(['success' => true, 'message' => 'Customer Data has been DELETED !']);
    }
}
