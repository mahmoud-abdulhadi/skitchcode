<?php

namespace App\Policies;

use App\User;
use App\Workspace;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the workspace.
     *
     * @param  \App\User  $user
     * @param  \App\Workspace  $workspace
     * @return mixed
     */
    public function view(User $user, Workspace $workspace)
    {
        //
    }

    /**
     * Determine whether the user can create workspaces.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the workspace.
     *
     * @param  \App\User  $user
     * @param  \App\Workspace  $workspace
     * @return mixed
     */
    public function update(User $user, Workspace $workspace)
    {
        
        return $workspace->user_id == $user->id  || $workspace->isParticipant($user) ; 
    }

    /**
     * Determine whether the user can delete the workspace.
     *
     * @param  \App\User  $user
     * @param  \App\Workspace  $workspace
     * @return mixed
     */
    public function delete(User $user, Workspace $workspace)
    {
        return $workspace->user_id == $user->id ; 
    }


    
}
