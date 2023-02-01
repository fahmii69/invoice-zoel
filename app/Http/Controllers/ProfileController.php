<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('permission:user.index')->only('index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // $this->title  = "Edit User";
        $title  = "Profile Information";
        $user   = $request->user();
        // $this->action = route($this->route . 'update', $user);


        return view('profile.edit', compact('title', 'user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->validated());

        DB::beginTransaction();

        try {
            $request->user()->fill($request->safe(
                [
                    'name',
                    'email',
                ]
            ));

            if ($request->password) {
                $request->user()->password = $request->password;
            }

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->update();

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

        DB::commit();
        return Redirect::route('profile.edit')->with($notification);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
