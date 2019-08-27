<?php

namespace App\Policies;

use App\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any admin users.
     *
     * @param  \App\AdminUser  $user
     * @return mixed
     */
    public function viewAny(AdminUser $user)
    {
        //
    }

    /**
     * Determine whether the user can view the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function view(AdminUser $user, AdminUser $adminUser)
    {
      if($user->hasPermissionTo('View Users')){
        return true
      }
    }

    /**
     * Determine whether the user can create admin users.
     *
     * @param  \App\AdminUser  $user
     * @return mixed
     */
    public function create(AdminUser $user)
    {
        //
    }

    /**
     * Determine whether the user can update the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function update(AdminUser $user, AdminUser $adminUser)
    {
        if($user->hasPermissionTo('Edit Users')){
          return true
        }
    }

    /**
     * Determine whether the user can delete the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function delete(AdminUser $user, AdminUser $adminUser)
    {
        //
    }

    /**
     * Determine whether the user can restore the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function restore(AdminUser $user, AdminUser $adminUser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function forceDelete(AdminUser $user, AdminUser $adminUser)
    {
        //
    }
}
