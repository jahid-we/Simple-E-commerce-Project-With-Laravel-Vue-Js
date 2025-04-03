<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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
        $this->configureRateLimiting();
         // Share isCookie globally to all Inertia responses
         Inertia::share([
            'isCookie' => Cookie::has('token'),
        ]);


    }


    // Rate limiting

    protected function configureRateLimiting(): void
    {
    RateLimiter::for('custom', function (Request $request) {
    return Limit::perMinute(5)->by($request->ip())->response(function ()
    {
    return ResponseHelper::Out(false, 'Too many requests. Please try again later...', 429);
    });
    });
    }

}
