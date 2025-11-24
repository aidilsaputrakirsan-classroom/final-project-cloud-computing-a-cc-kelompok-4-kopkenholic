<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan Bootstrap 4 untuk pagination
        Paginator::useBootstrapFour();

        // Kirim SiteSetting ke semua view frontend & dashboard
        View::composer('*', function ($view) {
            $view->with('sitesettings', SiteSetting::first());
        });
    }
}
