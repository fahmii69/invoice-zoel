<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $route = "user.",
        protected string $routeView = "master_data.user.",
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
        $this->title = 'User';
        return view($this->routeView . "index", $this->data);
    }

    public function getUser(Request $request)
    {
        if ($request->ajax()) {
            $data = User::oldest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = route('user.edit', $data->id);
                    $canEdit = $this->auth->can('user.edit');
                    $canDelete = $this->auth->can('user.delete');
                    // $canDelete = true;


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
        $this->title  = "Add User";
        $this->user   = new User();
        $this->roles   = Role::get();
        $this->action = route($this->route . 'store');

        if ($this->auth->can('user.create')) {
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
     * @param  StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        if ($this->auth->can('user.store')) {
            try {
                $user = new User($request->safe(
                    [
                        'name',
                        'email',
                        'password',
                    ]
                ));

                $getRole = Role::find($request->role);
                $role = match ($getRole->id) {
                    1 => $user->role = "Admin",
                    2 => $user->role = "User",
                };


                $user->save();

                $user->syncRoles([$role]);

                $notification = array(
                    'message'    => 'User data has been added!',
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
     * @param  User $user
     * @return View|RedirectResponse
     */
    public function edit(User $user): View|RedirectResponse
    {
        $this->title  = "Edit User";
        $this->user   = $user;
        $this->roles  = Role::get();
        $this->action = route($this->route . 'update', $user);

        if ($this->auth->can('user.edit')) {
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
     * @param  UpdateUserRequest $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        DB::beginTransaction();

        if ($this->auth->can('user.update')) {
            try {
                $user->fill($request->safe(
                    [
                        'name',
                        'email',
                    ]
                ));

                if ($request->password) {
                    $user->password = $request->password;
                }

                $getRole = Role::find($request->role);
                $role = match ($getRole->id) {
                    1 => $user->role = "Admin",
                    2 => $user->role = "User",
                };

                $user->update();

                $user->syncRoles([$role]);

                $notification = array(
                    'message'    => 'User data has been updated!',
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
     * Delete data.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        if ($this->auth->can('user.delete')) {

            $validation = Gate::inspect('adminDelete', [$user, $user->id]);

            if ($validation->allowed()) {
                $validation = User::destroy($user->id);
                return response()->json(['success' => true, 'message' => 'User Data has been DELETED !']);
            } else {
                $message = $validation->message();

                return response()->json(['success' => false, 'message' => $message]);
            }
        } else {
            return response()->json(['success' => false, 'message' => "You didn't have access for this action 😝 !!!"]);
        }
    }
}
