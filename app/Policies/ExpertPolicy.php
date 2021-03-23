<?php

namespace App\Policies;

use App\User;
use App\Expert;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpertPolicy
{
    use HandlesAuthorization;

    /**
     * check actions if user is administrator
     *
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the expert.
     *
     * @param  \App\User  $user
     * @param  \App\Expert  $expert
     * @return mixed
     */
    public function view(User $user, Expert $expert)
    {
        if ($user->id === $expert->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create experts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the expert.
     *
     * @param  \App\User  $user
     * @param  \App\Expert  $expert
     * @return mixed
     */
    public function update(User $user, Expert $expert)
    {
        //
    }

    /**
     * Determine whether the user can delete the expert.
     *
     * @param  \App\User  $user
     * @param  \App\Expert  $expert
     * @return mixed
     */
    public function delete(User $user, Expert $expert)
    {
        //
    }

    /**
     * Determine whether the user can restore the expert.
     *
     * @param  \App\User  $user
     * @param  \App\Expert  $expert
     * @return mixed
     */
    public function restore(User $user, Expert $expert)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the expert.
     *
     * @param  \App\User  $user
     * @param  \App\Expert  $expert
     * @return mixed
     */
    public function forceDelete(User $user, Expert $expert)
    {
        //
    }
}
