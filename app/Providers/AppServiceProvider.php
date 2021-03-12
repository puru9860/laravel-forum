<?php

namespace App\Providers;

use App\Models\Channel;
use Facade\FlareClient\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    //    view()->share('channels', Channel::all());
        view()->composer('*', function ($view) {
            $view->with('channels',Channel::all());
        });
    }
}
