<?php

namespace App\Providers;

use App\Http\View\Composer\MenuComposer;
use App\Http\View\Composer\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('component.menu', MenuComposer::class);
        View::composer('component.userinfo', UserComposer::class);
    }
}
