<?php

namespace App\Policies\Api;

use App\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    
    protected $className = 'role';

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
        $this->denyMessage();
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
        $this->denyMessage();
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
        $this->denyMessage();
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
        $this->denyMessage();
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
        $this->denyMessage();
    }

    public function denyMessage()
    {
        return $this->deny(config('auth.deny_message'));
    }
}
