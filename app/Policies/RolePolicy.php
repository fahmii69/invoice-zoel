<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role;

class RolePolicy
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
     * @param Role $role
     * @return Response
     */
    public function roleDelete(?User $user, Role $role)
    {
        if ($role->id == 1) {
            return Response::deny("This Role Can't be deleted 😂");
        }

        if ($role->id == 2) {
            return Response::deny("This Role Can't be deleted 😂");
        }

        if ($role->id == 3) {
            return Response::deny("This Role Can't be deleted 😂");
        }

        return Response::allow();
    }
}
