<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrapFive();
        Blade::if('auth', function () {
            return session('auth') ?? false;
        });
        Blade::if('notauth', function () {
            return !session('auth');
        });

        Blade::if('Notverified', function () {
            return is_null(session('auth')->email_verified_at);
        });
    }
}
