<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $title = "Category",
        protected string $route = "category.",
        protected string $routeView = "master_data.category.",
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

    public function getCategory(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = route('category.edit', $data->id);
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
            'category' => new Category(),
            'action'   => route($this->route . 'store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $supplier = new Category($request->safe(
                ['name']
            ));

            $supplier->save();

            $notification = array(
                'message'    => 'Category data has been added!',
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
     * @param  Category $category)
     * @return View
     */
    public function edit(Category $category): View
    {
        return view($this->routeView . "form", [
            'title'          => "Edit {$this->title}",
            'category' => $category,
            'action'   => route($this->route . 'update', $category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest $request
     * @param  Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $category->fill($request->safe(
                ['name', 'address', 'phone', 'pic']
            ));

            $category->update();

            $notification = array(
                'message'    => 'Category data has been updated!',
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
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        Category::destroy($category->id);

        return response()->json(['success' => true, 'message' => 'Category Data has been DELETED !']);
    }
}
