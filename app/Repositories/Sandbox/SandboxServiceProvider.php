<?php

namespace App\Repositories\Sandbox;


use Illuminate\Support\ServiceProvider;


class SandboxServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Sandbox\SandboxInterface', 'App\Repositories\Sandbox\EloquentSandboxRepository');
    }
}