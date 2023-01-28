<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SupplierController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $route = "supplier.",
        protected string $routeView = "master_data.supplier.",
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
        $this->title = 'Supplier';
        return view($this->routeView . "index", $this->data);
    }

    public function getSupplier(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = route('supplier.edit', $data->id);
                    $canEdit = $this->auth->can('supplier.store');

                    return view('components.action-button', compact('data', 'route', 'canEdit'));
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
        $this->title    = "Add Supplier";
        $this->supplier = new Supplier();
        $this->action   = route($this->route . 'store');

        if ($this->auth->can('supplier.create')) {
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
     * @param  StoreSupplierRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSupplierRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $supplier = new Supplier($request->safe(
                ['name', 'address', 'phone', 'pic']
            ));

            $supplier->save();

            $notification = array(
                'message'    => 'Supplier data has been added!',
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
     * @param  Supplier $supplier
     * @return View|RedirectResponse
     */
    public function edit(Supplier $supplier): View|RedirectResponse
    {
        $this->title    = "Edit supplier";
        $this->supplier = $supplier;
        $this->action   = route($this->route . 'update', $supplier);

        if ($this->auth->can('supplier.create')) {
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
     * @param  UpdateSupplierRequest $request
     * @param  Supplier $supplier
     * @return RedirectResponse
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $supplier->fill($request->safe(
                ['name', 'address', 'phone', 'pic']
            ));

            $supplier->update();

            $notification = array(
                'message'    => 'Supplier data has been updated!',
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
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        if ($this->auth->can('supplier.delete')) {
            Supplier::destroy($supplier->id);

            return response()->json(['success' => true, 'message' => 'Supplier Data has been DELETED !']);
        } else {
            return response()->json(['success' => false, 'message' => "You didn't have access for this action 😝 !!!"]);
        }
    }
}
