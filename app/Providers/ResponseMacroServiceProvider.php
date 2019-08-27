<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

         Response::macro('success', function ($message, $statusCode = 200) {
            return Response::json([
                'success' => [
                    'message' => $message
                ]
            ], $statusCode);
        });
         
        Response::macro('error', function ($message, $statusCode = 500) {
            return Response::json([
                'error' => [
                    'message' => $message
                ]
            ], $statusCode);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
