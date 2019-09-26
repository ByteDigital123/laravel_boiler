<?php

namespace App\Repositories\Page;


use Illuminate\Support\ServiceProvider;


class PageRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Page\PageInterface', 'App\Repositories\Page\EloquentPageRepository');
    }
}
