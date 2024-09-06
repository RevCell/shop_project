<?php

namespace App\Policies;

use App\Models\User;
use App\Models\property_group;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyGrouppolicy
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
        return $user->role->permissions_chk("property_group_read");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\property_group  $propertyGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, property_group $propertyGroup)
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
        return $user->role->permissions_chk("property_group_create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\property_group  $propertyGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, property_group $propertyGroup)
    {
        return $user->role->permissions_chk("property_group_update")
            && !empty($propertyGroup);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\property_group  $propertyGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->role->permissions_chk("property_group_delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\property_group  $propertyGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, property_group $propertyGroup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\property_group  $propertyGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, property_group $propertyGroup)
    {
        //
    }
}
