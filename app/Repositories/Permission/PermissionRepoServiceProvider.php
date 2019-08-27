<?php

namespace App\Repositories\Permission;


use Illuminate\Support\ServiceProvider;


class PermissionRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Permission\PermissionInterface', 'App\Repositories\Permission\EloquentPermissionRepository');
    }
}