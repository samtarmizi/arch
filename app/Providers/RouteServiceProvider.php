<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapDatatableRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(function () {
                 collect(glob(base_path('/routes/web/*.php')))
                    ->each(function ($path) {
                        require $path;
                    });
             });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->as('api.')
             ->namespace($this->namespace . '\Api')
             ->group(function () {
                 collect(glob(base_path('/routes/api/*.php')))
                    ->each(function ($path) {
                        require $path;
                    });
             });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapDatatableRoutes()
    {
        Route::prefix('dt')
             ->middleware('api')
             ->as('dt.')
             ->namespace('App\Http\Datatables')
             ->group(function () {
                 collect(glob(base_path('/routes/dt/*.php')))
                    ->each(function ($path) {
                        require $path;
                    });
             });
    }
}
