<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(
        protected string $route = "role.",
        protected string $routeView = "master_data.role.",
    ) {
        parent::__construct();
        // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        abort_if(!$this->auth->can('role.index'), 404);
        $this->title = 'Role';

        return view($this->routeView . "index", $this->data);
    }

    public function getRole(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::oldest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = route('role.edit', $data->id);
                    $canEdit = $this->auth->can('role.edit');
                    $canDelete = $this->auth->can('role.delete');
                    if ($data->id == 1) {
                    } else {
                        return view('components.action-button', compact('data', 'route', 'canEdit', 'canDelete'));
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
        $this->title      = "Add Role";
        $permission       = Permission::orderBy('type', 'asc')->get();
        $this->permission = $permission;
        $this->role       = new Role();
        $this->action     = route($this->route . 'store');

        if ($this->auth->can('role.create')) {
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
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        if ($this->auth->can('role.store')) {
            try {

                $this->validate($request, [
                    'name' => 'required|unique:roles,name',
                ]);

                $role = Role::create(['guard_name' => 'web', 'name' => $request->input('name')]);

                $role->syncPermissions($request->input('permission'));

                $notification = array(
                    'message'    => 'Role data has been added!',
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
        } else {
            DB::rollBack();
            $notification = array(
                'message'    => "You didn't have access to input on this page 😝 !!!",
                'alert-type' => 'error'
            );
        }
        DB::commit();
        return redirect()
            ->route($this->route . "index")
            ->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role $role
     * @return View|RedirectResponse
     */
    public function edit(Role $role): View|RedirectResponse
    {
        $this->title           = "Edit Role";
        $this->permission      = Permission::orderBy('type', 'asc')->get();
        $this->role            = $role;
        $this->action          = route($this->route . 'update', $role);
        $this->rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id')
            ->all();

        if ($this->auth->can('role.edit')) {
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
     * @param  Request  $request
     * @param  Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        DB::beginTransaction();

        if ($this->auth->can('role.update')) {
            try {
                $this->validate($request, [
                    'name' => 'required',
                ]);

                $role->name = $request->input('name');
                $role->update();

                $role->syncPermissions($request->input('permission'));

                $notification = array(
                    'message'    => 'Role data has been updated!',
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
        } else {
            DB::rollBack();
            $notification = array(
                'message'    => "You didn't have access to input on this page 😝 !!!",
                'alert-type' => 'error'
            );
        }

        DB::commit();
        return redirect()
            ->route($this->route . "index")
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        if ($this->auth->can('role.delete')) {

            $validation = Gate::inspect('roleDelete', $role);

            if ($validation->allowed()) {
                $validation = Role::destroy($role->id);
                return response()->json(['success' => true, 'message' => 'User Data has been DELETED !']);
            } else {
                $message = $validation->message();

                return response()->json(['success' => false, 'message' => $message]);
            }
            return response()->json(['success' => false, 'message' => "You didn't have access for this action 😝 !!!"]);
        }
    }
}
