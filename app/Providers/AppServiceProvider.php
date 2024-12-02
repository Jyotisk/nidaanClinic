<?php

namespace App\Providers;

use App\Models\MenuItem;
use App\Models\User\Facility;
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
            // $menuItems = MenuItem::orderby('order_by','ASC')->get(); // Or fetch menu items as needed
             $menuItems = Facility::where('status',true)->select('id','facility_name','type')->orderby('facility_name','ASC')->get(); // Or fetch menu items as needed

            $view->with('menuItems', $menuItems);
        });
    }
}
