<?php

namespace App\Providers;

use App\Models\Program;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $view->with('tauf', Setting::all_cached());
        });

        View::composer('partials.front.header', function ($view) {
            $view->with('navPrograms', Program::published()->orderBy('order')->take(8)->get());
        });

        View::composer('partials.front.footer', function ($view) {
            $view->with('footerPrograms', Program::published()->orderBy('order')->take(5)->get());
        });
    }
}
