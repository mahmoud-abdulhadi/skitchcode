<?php

namespace App\Policies;

use App\User;
use App\Skitch;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkitchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the skitch.
     *
     * @param  \App\User  $user
     * @param  \App\Skitch  $skitch
     * @return mixed
     */
    public function view(User $user, Skitch $skitch)
    {
        //
    }

    /**
     * Determine whether the user can create skitches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the skitch.
     *
     * @param  \App\User  $user
     * @param  \App\Skitch  $skitch
     * @return mixed
     */
    public function update(User $user, Skitch $skitch)
    {
        return $skitch->user_id == $user->id  ; 
    }

    /**
     * Determine whether the user can delete the skitch.
     *
     * @param  \App\User  $user
     * @param  \App\Skitch  $skitch
     * @return mixed
     */
    public function delete(User $user, Skitch $skitch)
    {
        return $skitch->user_id == $user->id ; 
    }
}
