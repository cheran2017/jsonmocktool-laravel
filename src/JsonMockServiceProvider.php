<?php

namespace Lib\JsonMock;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Facades;

class JsonMockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->router->group([
            'namespace' => 'Lib\JsonMock\Controllers',
            
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
 
        
    }
}
