<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\category;
use Illuminate\Auth\Access\HandlesAuthorization;

class Categorypolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role->permissions_chk("category_read");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, category $category)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role->permissions_chk("category_create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, category $category)
    {
        return $user->role->permissions_chk("category_update")
            && @empty($category);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->role->permissions_chk("category_delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, category $category)
    {
        //
    }
}
