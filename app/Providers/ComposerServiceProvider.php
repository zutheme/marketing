<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\sv_customer;
// use App\Http\Controllers\ControllerName;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // You can use a class for composer
        // you will need NavComposer@compose method
        // which will be called everythime partials.nav is requested
        View::composer(
            'admin.dashboard', 'App\Http\ViewComposers\NavComposer'
        );

        // You can use Closure based composers
        // which will be used to resolve any data
        // in this case we will pass menu items from database
        View::composer(['admin.dashboard','dashboard'], function ($view) {
            $menu = "main menu test";
            $view->with('menu', $menu);
        });
        //View::composer(['partials.nav', 'partials.top-nav'], handler)
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
