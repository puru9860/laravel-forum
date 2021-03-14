<?php

namespace App\Providers;

use App\Models\Channel;
use Facade\FlareClient\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $channels = Cache::rememberForever('channels', function () {
                return Channel::all();
            });
            $view->with('channels',$channels);
        });
    }
}
