<?php

namespace App\Repositories\Role;


use Illuminate\Support\ServiceProvider;


class RoleRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Role\RoleInterface', 'App\Repositories\Role\EloquentRoleRepository');
    }
}