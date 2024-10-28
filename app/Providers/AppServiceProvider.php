<?php

namespace App\Providers;

use App\Models\MenuItem;
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
        View::composer('layouts.guest', function ($view) {
            $menuItems = MenuItem::orderby('order_by','ASC')->get(); // Or fetch menu items as needed
            $view->with('menuItems', $menuItems);
        });
    }
}
