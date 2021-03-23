<?php

namespace App\Policies;

use App\User;
use App\Advertising;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisingPolicy
{
    use HandlesAuthorization;

    /**
     * check actions if user is administrator
     *
     * @param $user
     * @param $advertising
     * @return bool
     */
    public function before($user, $advertising)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the advertising.
     *
     * @param  \App\User  $user
     * @param  \App\Advertising  $advertising
     * @return mixed
     */
    public function view(User $user, Advertising $advertising)
    {
        if ($user->id === $advertising->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create advertisings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the advertising.
     *
     * @param  \App\User  $user
     * @param  \App\Advertising  $advertising
     * @return mixed
     */
    public function update(User $user, Advertising $advertising)
    {

        // Check if user is the adver author
        if ($user->id === $advertising->user_id) {
            return true;
        }

        return false;

    }

    /**
     * Determine whether the user can delete the advertising.
     *
     * @param  \App\User  $user
     * @param  \App\Advertising  $advertising
     * @return mixed
     */
    public function delete(User $user, Advertising $advertising)
    {
        // Check if user is the adver author
        if ($user->id === $advertising->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the advertising.
     *
     * @param  \App\User  $user
     * @param  \App\Advertising  $advertising
     * @return mixed
     */
    public function restore(User $user, Advertising $advertising)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the advertising.
     *
     * @param  \App\User  $user
     * @param  \App\Advertising  $advertising
     * @return mixed
     */
    public function forceDelete(User $user, Advertising $advertising)
    {
        //
    }
}
