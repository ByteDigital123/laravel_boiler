<?php

namespace App\Policies;

use App\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy
{
    use HandlesAuthorization;

    protected $className = 'admin_user';


    /**
     * Determine whether the user can view the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function list()
    {
        if (Auth::user()->can(__FUNCTION__ . '_' . $this->className)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function view()
    {
        if (Auth::user()->can(__FUNCTION__ . '_' . $this->className)) {
            return true;
        }
    }

    /**
     * Determine whether the user can create admin users.
     *
     * @param  \App\AdminUser  $user
     * @return mixed
     */
    public function create()
    {
        if (Auth::user()->can(__FUNCTION__ . '_' . $this->className)) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function update()
    {
        if (Auth::user()->can(__FUNCTION__ . '_' . $this->className)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the admin user.
     *
     * @param  \App\AdminUser  $user
     * @param  \App\AdminUser  $adminUser
     * @return mixed
     */
    public function delete()
    {
        if (Auth::user()->can(__FUNCTION__ . '_' . $this->className)) {
            return true;
        }
    }
}
