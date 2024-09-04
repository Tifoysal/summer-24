<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\WishList;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Paginator::useBootstrap();
        $all_categories=[];

        if(Schema::hasTable('categories'))
        {
            $all_categories=Category::all();
        }

      
        view()->share('categories',$all_categories);
    }
}
