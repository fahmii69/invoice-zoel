<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * make policy for delete user (avoid wrong delete user account).
     *
     * @param User|null $user
     * @param User $id
     * @return Response
     */
    public function adminDelete(User $user, User $id): Response
    {
        if ($id->id == 1) {
            return Response::deny("This Account Can't be deleted 😂");
        }

        if ($id->id == 2) {
            return Response::deny("This Account Can't be deleted 😂");
        }

        if ($id->id == 3) {
            return Response::deny("This Account Can't be deleted 😂");
        }

        return Response::allow();
    }
}
