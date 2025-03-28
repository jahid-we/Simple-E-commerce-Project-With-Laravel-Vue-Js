<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Cookie;
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
         // Share isCookie globally to all Inertia responses
         Inertia::share([
            'isCookie' => Cookie::has('token'),
        ]);
    }
}
