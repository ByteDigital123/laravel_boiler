<?php

namespace App\Repositories\PermissionGroup;


use Illuminate\Support\ServiceProvider;


class PermissionGroupRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\PermissionGroup\PermissionGroupInterface', 'App\Repositories\PermissionGroup\EloquentPermissionGroupRepository');
    }
}